(function($, Drupal, drupalSettings) {
  Drupal.behaviors.molloClient = {
    attach(context, settings) {
      console.log("Mollo Client");

        $('#mollo-client', context)
          .once('mollo-client')
          .each(() => {});

    },
  };
})(jQuery, Drupal, drupalSettings);
