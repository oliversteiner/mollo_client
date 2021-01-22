(function($, Drupal, drupalSettings) {
  Drupal.behaviors.molloClient = {
    attach(context, settings) {
      console.log("Mollo Client");

        $('#mollo-artist', context)
          .once('mollo-artist')
          .each(() => {});

    },
  };
})(jQuery, Drupal, drupalSettings);
