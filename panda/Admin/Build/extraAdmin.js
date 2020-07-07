"use strict";

(function () {
  var fancyAreaSelector = ".fancy-textarea";
  document.addEventListener("DOMContentLoaded", function () {
    init();
  });

  function init() {
    if (isFancyTextarea() && isTrumowygLibrary()) {
      jQuery(fancyAreaSelector).trumbowyg({
        lang: "cs",
        btns: [['viewHTML'], ['undo', 'redo'], ['strong'], ['link'], ['unorderedList', 'orderedList']],
        removeformatPasted: true
      });
    }
  }

  function isTrumowygLibrary() {
    return typeof jQuery(fancyAreaSelector).trumbowyg !== "undefined";
  }

  function isFancyTextarea() {
    return jQuery(fancyAreaSelector).length;
  }
})();
//# sourceMappingURL=extraAdmin.js.map
