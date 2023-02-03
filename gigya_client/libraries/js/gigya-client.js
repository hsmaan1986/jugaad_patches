(function ($, Drupal, drupalSettings) {
  $(document).ready(function () {
    
    window.secondLang = drupalSettings.gigya_client.second_lang;

    window.sendEmail = function (data) {
        var key = SHA1(data['first_name'] + data['mail']);
        $.post( drupalSettings.path.baseUrl + "gigya/api/send_email/" + data['locale'], {
                first_name: data['first_name'],
                mail: data['mail'],
                locale: data['locale'],
                message_subject: data['subject'],
                key: key,
            }
        );
    }
    // Default custom events.
    window.__gigyaConf.customEventMap = {
        eventMap: [{
            events: '*',
            args: [function (e) {
                return e;
            }],
            method: function (e) {
                if (e.eventName === 'afterSubmit') {
                    event = e;
                    if (event.response.status == 'OK') {
                        var profile = event.profile;
                        var data = [];
                        data["first_name"] = profile.firstName;
                        data["mail"] = profile.email;
                        data["locale"] = profile.locale;
                        data["subject"] = Drupal.t('Welcome to Purina !');

                        if (secondLang && data["locale"] == secondLang) {
                            data["subject"] = Drupal.t('Willkommen bei Purina!');
                        }
                        window.sendEmail(data);
                    }
                }

                if (e.eventName === 'afterScreenLoad') {
                    // console.log(e);
                }

                else if (e.fullEventName === 'logout') {

                }
            }
        }]
    }
  });
})(jQuery, Drupal, drupalSettings);
