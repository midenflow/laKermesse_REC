/* ============================================
   La Kermesse – Booking with jQuery
   ============================================ */
(function ($) {
  "use strict";

  // ---------- CONFIG ----------
  var APP_CONFIG = {
    maxPartySize:     18,
    customPartyMax:   500,
    largePartyStart:  20,
    minDate:          null,
    maxAdvanceDays:   60,
    slotInterval:     30,

    // Minimum notice (in minutes) for bookings made for TODAY.
    minLeadTimeMinutes: 30,

    openingHours: {
      0: null,                                                        // Dimanche — fermé
      1: { lunch: ["12:00", "14:00"], dinner: ["19:00", "23:00"] },   // Lundi
      2: { lunch: ["12:00", "14:00"], dinner: ["19:00", "23:00"] },   // Mardi
      3: { lunch: ["12:00", "14:00"], dinner: ["19:00", "23:00"] },   // Mercredi
      4: { lunch: ["12:00", "14:00"], dinner: ["19:00", "23:00"] },   // Jeudi
      5: { lunch: ["12:00", "14:00"], dinner: ["19:00", "23:00"] },   // Vendredi
      6: { lunch: ["12:00", "14:00"], dinner: ["19:00", "23:00"] }    // Samedi
    },
    closedDates: [],

    // French day names used in the “Fermé le …” message
    dayNames: ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi']
  };

  // ---------- DOM ----------
  var $form            = $("#booking-form");
  var $date            = $("#date");
  var $time            = $("#time");
  var $party           = $("#partySize");
  var $partyCustom     = $("#partySizeCustom");
  var $partyBack       = $("#party-back");
  var $toStep2         = $("#to-step-2");
  var $submitBtn       = $("#submit-booking");
  var $globalError     = $("#global-error");
  var $availability    = $("#availability-status");
  var $summary         = $("#booking-summary");
  var $csrf            = $("#csrf-token");
  var $locationPicker  = $("#location-picker");
  var $locationCards   = $locationPicker.find(".location__card");
  var $locationRadios  = $locationPicker.find('input[name="location"]');
  var $hasAllergy      = $('input[name="hasAllergy"]');
  var $allergyDetails  = $("#allergy-details");
  var $allergyField    = $("#allergyDetails");

  // ---------- State ----------
  var selectedTime     = "";
  var selectedLocation = "";
  var customPartyMode  = false;

  // ---------- Helpers ----------
  function pad2(n) { return String(n).padStart(2, "0"); }

  function toLocalISODate(d) {
    return d.getFullYear() + "-" + pad2(d.getMonth() + 1) + "-" + pad2(d.getDate());
  }

  function getPartySize() {
    if (customPartyMode) {
      var v = parseInt($partyCustom.val(), 10);
      if (isNaN(v) || v < 19) return "";
      return String(v);
    }
    var s = $party.val();
    if (s === "+18" || s === "") return "";
    return s;
  }

  // ---------- Init ----------
  function init() {
    var today   = new Date();
    var minDate = toLocalISODate(today);
    APP_CONFIG.minDate = minDate;
    $date.attr("min", minDate);

    var max = new Date(today);
    max.setDate(max.getDate() + APP_CONFIG.maxAdvanceDays);
    $date.attr("max", toLocalISODate(max));

    // Populate 1..maxPartySize + the "+ de 18 personnes" entry
    for (var i = 1; i <= APP_CONFIG.maxPartySize; i++) {
      $party.append(
        $("<option>", {
          value: i,
          text: i + (i === 1 ? " personne" : " personnes")
        })
      );
    }
    $party.append($("<option>", { value: "+18", text: "+ de 18 personnes" }));
    $party.val("2");

    $date.val(minDate);
    refreshAvailability();
  }

  // ---------- Time slots ----------
  function generateTimeSlots(dateStr) {
    if (!dateStr) return [];
    var date = new Date(dateStr + "T12:00:00");
    if (isNaN(date.getTime())) return [];

    var day   = date.getDay();
    var hours = APP_CONFIG.openingHours[day];
    if (!hours) return [];
    if (APP_CONFIG.closedDates.indexOf(dateStr) !== -1) return [];

    var slots = [];

    function addRange(start, end) {
      if (!start || !end) return;
      var sp = start.split(":"), ep = end.split(":");
      var current = new Date(date);
      current.setHours(+sp[0], +sp[1], 0, 0);
      var endTime = new Date(date);
      endTime.setHours(+ep[0], +ep[1], 0, 0);

      while (current <= endTime) {
        slots.push(pad2(current.getHours()) + ":" + pad2(current.getMinutes()));
        current.setMinutes(current.getMinutes() + APP_CONFIG.slotInterval);
      }
    }

    if (hours.lunch)  addRange(hours.lunch[0],  hours.lunch[1]);
    if (hours.dinner) addRange(hours.dinner[0], hours.dinner[1]);

    var unique = [];
    slots.forEach(function (s) { if (unique.indexOf(s) === -1) unique.push(s); });
    unique.sort();

    // ---- Today → keep only future slots (+ lead time) ----
    var todayStr = toLocalISODate(new Date());
    if (dateStr === todayStr) {
      var cutoff = new Date();
      cutoff.setMinutes(cutoff.getMinutes() + APP_CONFIG.minLeadTimeMinutes);

      unique = unique.filter(function (slot) {
        var parts = slot.split(":");
        var slotDate = new Date(date);
        slotDate.setHours(+parts[0], +parts[1], 0, 0);
        return slotDate > cutoff;
      });
    }
    // -------------------------------------------------------

    return unique;
  }

  // ---------- Availability (preserves selectedTime) ----------
  function refreshAvailability() {
    var dateVal  = $date.val();
    var partyVal = getPartySize();

    // Reset any previous "closed" styling
    $availability.removeClass("is-closed");

    // No date → nothing meaningful, safe to clear the time
    if (!dateVal) {
      selectedTime = "";
      $time.prop("disabled", true).empty().append('<option value="">Choisir</option>');
      updateStep1Button();
      $availability.text("Choisissez une date pour voir les disponibilités.");
      return;
    }

    // Party size incomplete → leave the time dropdown untouched
    if (!partyVal) {
      updateStep1Button();
      $availability.text("Saisissez un nombre de 19 personnes ou plus.");
      return;
    }

    // Recompute slots from the date, preserve previous choice if still valid
    var previousTime = selectedTime || $time.val();
    var slots = generateTimeSlots(dateVal);

    $time.empty().append('<option value="">Choisir</option>');

    if (slots.length === 0) {
      $time.prop("disabled", true);
      selectedTime = "";
      updateStep1Button();

      // Is the chosen day closed per openingHours?
      var dayIndex    = new Date(dateVal + "T12:00:00").getDay();
      var isClosedDay = APP_CONFIG.openingHours[dayIndex] === null;

      if (isClosedDay) {
        $availability
          .addClass("is-closed")
          .text("Le restaurant est fermé le " + APP_CONFIG.dayNames[dayIndex] + ".");
      } else {
        var todayStr = toLocalISODate(new Date());
        var isToday  = dateVal === todayStr;
        $availability.text(
          isToday
            ? "Il n’y a plus de créneau disponible aujourd’hui. Essayez une autre date ou appelez-nous au 09 82 68 44 17."
            : "Aucun créneau disponible. Essayez une autre date."
        );
      }
      return;
    }

    slots.forEach(function (slot) {
      $time.append($("<option>", { value: slot, text: slot }));
    });

    if (previousTime && slots.indexOf(previousTime) !== -1) {
      $time.val(previousTime);
      selectedTime = previousTime;
    } else {
      selectedTime = "";
    }

    $time.prop("disabled", false);
    updateStep1Button();
    $availability.text(slots.length + " créneau(x) disponible(s)");
  }

  // ---------- Step-1 button state ----------
  function updateStep1Button() {
    var partyVal = getPartySize();
    var partyOk  = partyVal !== "" && parseInt(partyVal, 10) >= 1;
    $toStep2.prop("disabled", !(partyOk && !!selectedTime && !!selectedLocation));
  }

  // ---------- Errors ----------
  function showError(fieldId, message) {
    if (fieldId === "location") {
      $locationPicker.addClass("has-error");
    } else {
      $("#" + fieldId).closest(".field, .picker__cell").addClass("has-error");
    }
    $('[data-error-for="' + fieldId + '"]').text(message);
  }

  function clearError(fieldId) {
    if (fieldId === "location") {
      $locationPicker.removeClass("has-error");
    } else {
      $("#" + fieldId).closest(".field, .picker__cell").removeClass("has-error");
    }
    $('[data-error-for="' + fieldId + '"]').text("");
  }

  function clearAllErrors() {
    $(".field-error").text("");
    $(".location__error").text("");
    $(".field, .picker__cell").removeClass("has-error");
    $locationPicker.removeClass("has-error");
    $globalError.attr("hidden", true).text("");
  }

  // ---------- Validation ----------
  function validateStep1() {
    var valid = true;
    clearAllErrors();

    var partyVal = parseInt(getPartySize(), 10);

    if (!$date.val())  { showError("date", "Veuillez choisir une date.");   valid = false; }
    if (!$time.val())  { showError("time", "Veuillez choisir un horaire."); valid = false; }

    if (!partyVal || partyVal < 1) {
      showError("partySize", "Veuillez choisir le nombre de personnes.");
      valid = false;
    } else if (customPartyMode && partyVal < 19) {
      showError("partySize", "Veuillez saisir 19 personnes ou plus.");
      valid = false;
    } else if (partyVal > APP_CONFIG.customPartyMax) {
      showError("partySize",
        "Pour un groupe de plus de " + APP_CONFIG.customPartyMax +
        " personnes, merci de nous appeler au 09 82 68 44 17.");
      valid = false;
    }

    if (!$locationRadios.filter(":checked").length) {
      showError("location", "Veuillez choisir un emplacement (intérieur ou extérieur).");
      valid = false;
    }

    return valid;
  }

  function validateStep2() {
    var valid = true;
    clearAllErrors();

    var firstName = $.trim($("#firstName").val());
    var lastName  = $.trim($("#lastName").val());
    var email     = $.trim($("#email").val());
    var phone     = $.trim($("#phone").val()).replace(/[\s.\-]/g, "");

    if (firstName.length < 2) { showError("firstName", "Veuillez indiquer votre prénom (2 caractères min)."); valid = false; }
    if (lastName.length  < 2) { showError("lastName",  "Veuillez indiquer votre nom (2 caractères min).");    valid = false; }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showError("email", "Veuillez saisir une adresse e-mail valide.");
      valid = false;
    }

    if (!/^(?:\+33|0)[1-9]\d{8}$/.test(phone)) {
      showError("phone", "Veuillez saisir un numéro de téléphone français valide.");
      valid = false;
    }

    if ($('input[name="hasAllergy"]:checked').val() === "yes" &&
        $.trim($("#allergyDetails").val()).length < 3) {
      showError("allergyDetails",
        "Merci de préciser l’allergie ou l’intolérance (3 caractères min).");
      valid = false;
    }

    return valid;
  }

  // ---------- Navigation ----------
  function goToStep(step) {
    $(".step").attr("hidden", true);
    $('[data-step="' + step + '"]').removeAttr("hidden");

    $(".progress li").removeClass("is-current").removeAttr("aria-current");
    $('.progress li[data-progress="' + step + '"]').addClass("is-current").attr("aria-current", "step");

    var $heading = $('[data-step="' + step + '"] h2');
    if ($heading.length) {
      $heading.attr("tabindex", "-1").trigger("focus");
      $heading[0].scrollIntoView({ behavior: "smooth", block: "start" });
    }
    clearAllErrors();
  }

  // ---------- Summary ----------
  function populateSummary() {
    var parts  = $date.val().split("-");
    var pretty = parts[2] + "/" + parts[1] + "/" + parts[0];
    var locationLabel = selectedLocation === "inside" ? "Intérieur" : "Extérieur";

    var html = "";
    html += '<div><span>Date</span>'        + pretty         + '</div>';
    html += '<div><span>Heure</span>'       + $time.val()    + '</div>';
    html += '<div><span>Personnes</span>'   + getPartySize() + '</div>';
    html += '<div><span>Emplacement</span>' + locationLabel + '</div>';

    $summary.css("grid-template-columns", "repeat(4, 1fr)");
    $summary.html(html);
  }

  // ---------- Events ----------
  $(function () {
    init();

    // ----- Date change : the ONLY place that resets the time -----
    $date.on("change", function () {
      clearError("date");
      selectedTime = "";
      $time.val("");
      refreshAvailability();
    });

    // ----- Party dropdown -----
    $party.on("change", function () {
      var val = $(this).val();

      if (val === "+18") {
        customPartyMode = true;
        $party.hide();
        $partyCustom.prop("hidden", false).val("");
        $partyBack.prop("hidden", false);
        clearError("partySize");
        updateStep1Button();
        $availability.text("Saisissez un nombre de 19 personnes ou plus.");
        setTimeout(function () { $partyCustom.trigger("focus"); }, 30);
        return;
      }

      customPartyMode = false;
      clearError("partySize");
      refreshAvailability();
    });

    // ----- Custom number input -----
    $partyCustom.on("input", function () {
      clearError("partySize");
      var v = parseInt($(this).val(), 10);

      if (isNaN(v) || v < 19) {
        updateStep1Button();
        $availability.text("Saisissez un nombre de 19 personnes ou plus.");
        return;
      }

      if (v > APP_CONFIG.customPartyMax) {
        updateStep1Button();
        $availability.text(
          "Pour un groupe de plus de " + APP_CONFIG.customPartyMax +
          " personnes, merci de nous appeler au 09 82 68 44 17."
        );
        return;
      }

      refreshAvailability();
    });

    // ----- Back to the dropdown -----
    $partyBack.on("click", function () {
      customPartyMode = false;
      $partyCustom.prop("hidden", true).val("");
      $partyBack.prop("hidden", true);
      $party.show().val("2");
      clearError("partySize");
      refreshAvailability();
      $party.trigger("focus");
    });

    // ----- Time -----
    $time.on("change", function () {
      selectedTime = $(this).val();
      clearError("time");
      updateStep1Button();
    });

    // ----- Location cards -----
    $locationCards.on("click", function () {
      var $radio = $(this).find('input[name="location"]');
      if (!$radio.prop("checked")) {
        $radio.prop("checked", true).trigger("change");
      }
    });

    $locationRadios.on("change", function () {
      selectedLocation = $(this).val();
      $locationCards.removeClass("is-selected");
      $(this).closest(".location__card").addClass("is-selected");
      clearError("location");
      updateStep1Button();
    });

    // ----- Allergy toggle -----
    $hasAllergy.on("change", function () {
      if ($(this).val() === "yes") {
        $allergyDetails.prop("hidden", false);
        setTimeout(function () { $allergyField.trigger("focus"); }, 30);
      } else {
        $allergyDetails.prop("hidden", true);
        $allergyField.val("");
        clearError("allergyDetails");
      }
    });

    // ----- Step 1 → 2 -----
    $toStep2.on("click", function () {
      if (!validateStep1()) return;
      populateSummary();
      goToStep(2);
    });

    $("[data-back]").on("click", function () { goToStep(1); });

    // ----- Clear field errors while typing -----
    $form.on("input change", "input:not([type=hidden]), select, textarea", function () {
      if (this.id) clearError(this.id);
    });

    // ----- Submit -----
    $form.on("submit", function (e) {
      e.preventDefault();
      clearAllErrors();

      if (!validateStep2()) {
        var $firstError = $(".has-error").first();
        if ($firstError.length) {
          $firstError.find("input, select, textarea").first().trigger("focus");
          $firstError[0].scrollIntoView({ behavior: "smooth", block: "center" });
        }
        return;
      }

      var payload = {
        csrf:           $csrf.val(),
        date:           $date.val(),
        time:           $time.val(),
        partySize:      getPartySize(),
        location:       selectedLocation,
        firstName:      $.trim($("#firstName").val()),
        lastName:       $.trim($("#lastName").val()),
        email:          $.trim($("#email").val()),
        phone:          $.trim($("#phone").val()),
        message:        $.trim($("#message").val()),
        website:        $("#website").val(),
        hasAllergy:     $('input[name="hasAllergy"]:checked').val(),
        allergyDetails: $.trim($("#allergyDetails").val())
      };

      $submitBtn
        .prop("disabled", true)
        .html('Envoi en cours… <span aria-hidden="true">&#9203;</span>');

      $.ajax({
        url: "assets/includes/send_booking.php",
        type: "POST",
        dataType: "json",
        data: payload
      })
        .done(function (response) {
          if (response.success) {
            $(".progress, .panel__lead, #booking-title").hide();
            $("#result-reference").text(response.reference || "—");
            $("#result-title").text(
              response.status === "confirmed"
                ? "Votre table est confirmée."
                : "Votre demande est en attente."
            );
            $("#result-copy").text(
              response.status === "confirmed"
                ? "Votre réservation a été enregistrée. Un mail de confirmation vous a été envoyé."
                : "L’équipe validera votre demande selon les disponibilités. Vous recevrez un e-mail de confirmation."
            );
            goToStep(3);
          } else {
            $globalError
              .removeAttr("hidden")
              .text(response.message || "Une erreur est survenue. Veuillez réessayer.");
            $submitBtn
              .prop("disabled", false)
              .html('Envoyer ma demande <span aria-hidden="true">&#8594;</span>');
          }
        })
        .fail(function (xhr) {
          var msg = "Le serveur de réservation est inaccessible. Vérifiez votre connexion puis réessayez.";
          if (xhr.responseJSON && xhr.responseJSON.message) {
            msg = xhr.responseJSON.message;
          } else if (xhr.status === 0) {
            msg = "Connexion impossible. Vérifiez que le serveur est bien démarré.";
          }
          $globalError.removeAttr("hidden").text(msg);
          $submitBtn
            .prop("disabled", false)
            .html('Envoyer ma demande <span aria-hidden="true">&#8594;</span>');
        });
    });
  });
})(jQuery);