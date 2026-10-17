/* ============================================
   La Kermesse – Event booking with jQuery
   ============================================ */
(function ($) {
  "use strict";

  // ---------- CONFIG ----------
  // Party limits must stay identical to send_event_booking.php (10 to 300)
  var APP_CONFIG = {
    minPartySize:       10,
    maxPartySize:       300,
    minDate:            null,
    maxAdvanceDays:     730,
    slotInterval:       30,
    minLeadTimeMinutes: 30,
    phone:              "09 82 68 44 17",

    openingHours: {
      0: null,
      1: { lunch: ["12:00", "14:00"], dinner: ["19:00", "23:00"] },
      2: { lunch: ["12:00", "14:00"], dinner: ["19:00", "23:00"] },
      3: { lunch: ["12:00", "14:00"], dinner: ["19:00", "23:00"] },
      4: { lunch: ["12:00", "14:00"], dinner: ["19:00", "23:00"] },
      5: { lunch: ["12:00", "14:00"], dinner: ["19:00", "23:00"] },
      6: { lunch: ["12:00", "14:00"], dinner: ["19:00", "23:00"] }
    },
    closedDates: [],
    dayNames: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"]
  };

  // ---------- DOM ----------
  var $form            = $("#event-form");
  var $date            = $("#date");
  var $time            = $("#time");
  var $party           = $("#partySizeCustom");
  var $submitBtn       = $("#submit-event");
  var $globalError     = $("#global-error");
  var $availability    = $("#availability-status");
  var $csrf            = $("#csrf-token");
  var $locationPicker  = $("#location-picker");
  var $locationCards   = $locationPicker.find(".location__card");
  var $locationRadios  = $locationPicker.find('input[name="location"]');

  var SUBMIT_LABEL = 'Envoyer ma demande <span aria-hidden="true">&#8594;</span>';

  // ---------- State ----------
  var selectedTime     = "";
  var selectedLocation = "";

  // ---------- Helpers ----------
  function pad2(n) { return String(n).padStart(2, "0"); }

  function toLocalISODate(d) {
    return d.getFullYear() + "-" + pad2(d.getMonth() + 1) + "-" + pad2(d.getDate());
  }

  // Number of guests typed in the field (0 when empty => invalid)
  function getPartySize() {
    var n = parseInt($party.val(), 10);
    return isNaN(n) ? 0 : n;
  }

  function partyIsValid() {
    var n = getPartySize();
    return n >= APP_CONFIG.minPartySize && n <= APP_CONFIG.maxPartySize;
  }

  function partyMessage() {
    var n = getPartySize();
    if (!n) return "Indiquez le nombre de personnes (minimum " + APP_CONFIG.minPartySize + ").";
    if (n < APP_CONFIG.minPartySize) {
      return "Pour un événement, le minimum est de " + APP_CONFIG.minPartySize + " personnes.";
    }
    if (n > APP_CONFIG.maxPartySize) {
      return "Pour un groupe de plus de " + APP_CONFIG.maxPartySize +
             " personnes, merci de nous appeler au " + APP_CONFIG.phone + ".";
    }
    return "";
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
    $party.attr({ min: APP_CONFIG.minPartySize, max: APP_CONFIG.maxPartySize });
    $party.val("");

    $date.val(minDate);
    refreshAvailability();
  }

  // ---------- Time slots ----------
  function generateTimeSlots(dateStr) {
    if (!dateStr) return [];
    var date = new Date(dateStr + "T12:00:00");
    if (isNaN(date.getTime())) return [];

    var hours = APP_CONFIG.openingHours[date.getDay()];
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

    if (dateStr === toLocalISODate(new Date())) {
      var cutoff = new Date();
      cutoff.setMinutes(cutoff.getMinutes() + APP_CONFIG.minLeadTimeMinutes);

      unique = unique.filter(function (slot) {
        var parts = slot.split(":");
        var slotDate = new Date(date);
        slotDate.setHours(+parts[0], +parts[1], 0, 0);
        return slotDate > cutoff;
      });
    }

    return unique;
  }

  // ---------- Availability (depends on the date only) ----------
  function refreshAvailability() {
    var dateVal = $date.val();

    $availability.removeClass("is-closed");

    if (!dateVal) {
      selectedTime = "";
      $time.prop("disabled", true).empty().append('<option value="">Choisir</option>');
      updateSubmitButton();
      $availability.text("Choisissez une date pour voir les disponibilités.");
      return;
    }

    var previousTime = selectedTime || $time.val();
    var slots = generateTimeSlots(dateVal);

    $time.empty().append('<option value="">Choisir</option>');

    if (slots.length === 0) {
      $time.prop("disabled", true);
      selectedTime = "";
      updateSubmitButton();

      var dayIndex    = new Date(dateVal + "T12:00:00").getDay();
      var isClosedDay = APP_CONFIG.openingHours[dayIndex] === null;

      if (isClosedDay) {
        $availability
          .addClass("is-closed")
          .text("Nous sommes fermés le " + APP_CONFIG.dayNames[dayIndex] + " — essayez une autre date ou appelez-nous.");
      } else if (dateVal === toLocalISODate(new Date())) {
        $availability.text("Il n’y a plus de créneau disponible aujourd’hui. Essayez une autre date ou appelez-nous au " + APP_CONFIG.phone + ".");
      } else {
        $availability.text("Aucun créneau disponible. Essayez une autre date.");
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
    updateSubmitButton();
    $availability.text(slots.length + " créneau(x) disponible(s)");
  }

  // ---------- Submit button state ----------
  function updateSubmitButton() {
    $submitBtn.prop("disabled", !(partyIsValid() && !!selectedTime && !!selectedLocation));
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
  function validateForm() {
    var valid = true;
    clearAllErrors();

    var firstName = $.trim($("#firstName").val());
    var lastName  = $.trim($("#lastName").val());
    var eventType = $("#eventType").val();
    var email     = $.trim($("#email").val());
    var phone     = $.trim($("#phone").val()).replace(/[\s.\-]/g, "");

    if (!$date.val()) { showError("date", "Veuillez choisir une date.");   valid = false; }
    if (!$time.val()) { showError("time", "Veuillez choisir un créneau."); valid = false; }

    if (!partyIsValid()) {
      showError("partySize", partyMessage());
      valid = false;
    }

    if (firstName.length < 2) { showError("firstName", "Veuillez indiquer votre prénom (2 caractères min)."); valid = false; }
    if (lastName.length  < 2) { showError("lastName",  "Veuillez indiquer votre nom (2 caractères min).");    valid = false; }

    if (!eventType) {
      showError("eventType", "Veuillez choisir un type d’événement.");
      valid = false;
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showError("email", "Veuillez saisir une adresse e-mail valide.");
      valid = false;
    }

    if (!/^(?:\+33|0)[1-9]\d{8}$/.test(phone)) {
      showError("phone", "Veuillez saisir un numéro de téléphone français valide.");
      valid = false;
    }

    if (!$locationRadios.filter(":checked").length) {
      showError("location", "Veuillez choisir un emplacement (intérieur ou extérieur).");
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

  // ---------- Events ----------
  $(function () {
    init();

    $date.on("change", function () {
      clearError("date");
      selectedTime = "";
      $time.val("");
      refreshAvailability();
    });

    // Number of guests (visible field)
    $party.on("input change", function () {
      clearError("partySize");

      var n = getPartySize();
      if (n && !partyIsValid()) {
        $availability.removeClass("is-closed").text(partyMessage());
        updateSubmitButton();
        return;
      }
      refreshAvailability();
    });

    $time.on("change", function () {
      selectedTime = $(this).val();
      clearError("time");
      updateSubmitButton();
    });

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
      updateSubmitButton();
    });

    $form.on("input change", "input:not([type=hidden]), select, textarea", function () {
      if (this.id) clearError(this.id);
    });

    // ----- Submit -----
    $form.on("submit", function (e) {
      e.preventDefault();
      clearAllErrors();

      if (!validateForm()) {
        var $firstError = $(".has-error").first();
        if ($firstError.length) {
          // focus the first VISIBLE control (the party dropdown is hidden)
          $firstError.find("input, select, textarea").filter(":visible").first().trigger("focus");
          $firstError[0].scrollIntoView({ behavior: "smooth", block: "center" });
        }
        return;
      }

      var payload = {
        csrf:      $csrf.val(),
        eventDate: $date.val(),
        eventTime: $time.val(),
        partySize: getPartySize(),
        eventType: $("#eventType").val(),
        location:  selectedLocation,
        firstName: $.trim($("#firstName").val()),
        lastName:  $.trim($("#lastName").val()),
        email:     $.trim($("#email").val()),
        phone:     $.trim($("#phone").val()),
        message:   $.trim($("#message").val()),
        website:   $("#website").val() || ""
      };

      $submitBtn
        .prop("disabled", true)
        .html('Envoi en cours… <span aria-hidden="true">&#9203;</span>');

      $.ajax({
        url: "assets/includes/send_event_booking.php",
        type: "POST",
        dataType: "json",
        data: payload
      })
        .done(function (response) {
          if (response.success) {
            $("#result-reference").text(response.reference || "—");
            $("#result-title").text("Votre réservation est confirmée.");
			$("#result-copy").html(
			  "Un mail de confirmation vient de vous être envoyé.<br>Vous ne le trouvez pas&nbsp;? Pensez à vérifier votre dossier <strong>courriers indésirables (spam).</strong>"
			);
			$("#event-title, .panel__lead, .progress").hide();
            goToStep(2);
          } else {
            $globalError
              .removeAttr("hidden")
              .text(response.message || "Une erreur est survenue. Veuillez réessayer.");
            $submitBtn.prop("disabled", false).html(SUBMIT_LABEL);
          }
        })
        .fail(function (xhr) {
          var msg = "Le serveur est inaccessible. Vérifiez votre connexion puis réessayez.";
          if (xhr.responseJSON && xhr.responseJSON.message) {
            msg = xhr.responseJSON.message;
          } else if (xhr.status === 0) {
            msg = "Connexion impossible. Vérifiez votre connexion internet puis réessayez.";
          }
          $globalError.removeAttr("hidden").text(msg);
          $submitBtn.prop("disabled", false).html(SUBMIT_LABEL);
        });
    });
  });
})(jQuery);