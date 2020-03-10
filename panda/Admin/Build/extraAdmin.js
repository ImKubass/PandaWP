"use strict";

(function () {
  var fancyArea = ".fancy-textarea";
  document.addEventListener("DOMContentLoaded", function (event) {
    init();
  });

  function init() {
    if (isFancyTextarea() && isTrumowygLibrary()) {
      jQuery(fancyArea).trumbowyg({
        lang: "cs",
        btns: [['viewHTML'], ['undo', 'redo'], ['strong'], ['link'], ['unorderedList', 'orderedList']],
        removeformatPasted: true
      });
    }
  }

  function isTrumowygLibrary() {
    return typeof jQuery(fancyArea).trumbowyg !== "undefined";
  }

  function isFancyTextarea() {
    return jQuery(fancyArea).length;
  }
})();
//# sourceMappingURL=extraAdmin.js.map