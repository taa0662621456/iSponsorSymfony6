/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./asset/js/full_screen.js":
/*!*********************************!*\
  !*** ./asset/js/full_screen.js ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_filter_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.filter.js */ "./node_modules/core-js/modules/es.array.filter.js");
/* harmony import */ var core_js_modules_es_array_filter_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_filter_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var js_cookie__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! js-cookie */ "./node_modules/js-cookie/dist/js.cookie.mjs");
/* harmony import */ var masonry_layout__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! masonry-layout */ "./node_modules/masonry-layout/masonry.js");
/* harmony import */ var masonry_layout__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(masonry_layout__WEBPACK_IMPORTED_MODULE_3__);





//let grid = document.querySelector('#masonry-grid');
var fullScreenButton = document.querySelector('#full-screen');
var masonryGrid = document.querySelector('#masonry-grid');
if (fullScreenButton != null && masonryGrid != null) {
  var fullScreenIcon = function fullScreenIcon() {
    $fullScreenIcon.toggleClass($fullScrIconClass, $fullScrIconPress);
  };
  var asideRightPanel = function asideRightPanel() {
    $asideRightPanel.css('background-color', 'transparent').toggleClass('absolutepanel').css('right', 'inherit!important').unbind('click');
  };
  var masonryLayout = function masonryLayout() {
    if ($masonryGrid.length !== 0) {
      $masonry.layout();
    }
  };
  var $html = $('html');
  var $hideArray = $('#b1, #b2, #header, #p1, #p2');
  var $panel = $('#panel').filter('div');
  var $contentBlock = $('#b3').filter('article');
  var $asideRightPanel = $('#b4').filter('div');
  var $fullScreenButton = $('#full-screen').filter('button');
  var $fullScreenMessage = $('#fullscreen-message').filter('div');
  var $fullScreenIcon = $('#fa-full-screen').filter('i');
  var $fullScrIconClass = 'fa-arrows';
  var $fullScrIconPress = 'fa-compress-arrows-alt';
  var $width = 100 * $contentBlock.width() / $contentBlock.parent().width();
  var $masonryBrick = $('.masonry-brick').filter('div');
  var $masonryGrid = $('#masonry-grid:first').filter('div');
  if ($masonryGrid.length !== 0) {
    var $masonry = new (masonry_layout__WEBPACK_IMPORTED_MODULE_3___default())('#masonry-grid', {
      // options...
      itemSelector: '.masonry-brick'
    });
    $masonry.layout();
  }
  if (js_cookie__WEBPACK_IMPORTED_MODULE_2__["default"].get('screen')) {
    $masonryBrick.css('width', js_cookie__WEBPACK_IMPORTED_MODULE_2__["default"].get('screen'));
    masonryLayout();
  } else {
    $masonryBrick.css('width', '25%');
    masonryLayout();
  }
  $fullScreenButton.click(function () {
    if (Math.round($width) === 100) {
      $hideArray.show();
      $contentBlock.removeClass('col-lg-12 col-sm-12 col-md-12').addClass('col-lg-8 col-sm-6 col-md-8');
      $panel.removeClass('col-sm-12 col-md-12 col-lg-12').addClass('col-sm-6 col-md-8 col-lg-8');
      $asideRightPanel.css('background-color', 'transparent').toggleClass('absolutepanel').css('right', 'inherit!important').unbind('click');
      fullScreenIcon();
      $width = 0;
    } else {
      $contentBlock.removeClass('col-lg-8 col-sm-6 col-md-8').addClass('col-lg-12 col-sm-12 col-md-12');
      $panel.removeClass('col-sm-6 col-md-8 col-lg-8').addClass('col-sm-12 col-md-12 col-lg-12');
      $hideArray.hide();
      $asideRightPanel.toggleClass('absolutepanel').toggle(function () {
        $asideRightPanel.animate({
          right: '-165px'
        }, 500);
      }, function () {
        $asideRightPanel.animate({
          right: 0
        }, 500);
      });
      $asideRightPanel.css('background-color', 'transparent').toggleClass('absolutepanel').css('right', 'inherit!important').unbind('click');
      fullScreenIcon();
      $width = 100;
    }
    masonryLayout();
  });
  $fullScreenButton.on('shown.bs.modal', function () {
    $('#saveFullScreen').trigger('focus');
  });
  $html.keypress(function (e) {
    if (e.keyCode === 27 && $width === 100) {
      $fullScreenMessage.modal();
      $hideArray.show();
      $contentBlock.removeClass('col-lg-12 col-sm-12 col-md-12').addClass('col-lg-8 col-sm-6 col-md-8');
      asideRightPanel();
      fullScreenIcon();
      masonryLayout();
    }
    $width = 0;
  });
}

/***/ }),

/***/ "./asset/js/move_up.js":
/*!*****************************!*\
  !*** ./asset/js/move_up.js ***!
  \*****************************/
/***/ (() => {

window.onload = function () {
  window.addEventListener('load', function (event) {
    var moveUp = document.div.querySelectorAll("#move_up");
    var moveUpBlock = document.querySelectorAll("#b1");
    window.scroll = function () {
      if (this.scrollY > 400) {
        moveUp.fadeIn(600);
        moveUpBlock.css({
          'background-color': '#cfcfcf'
        });
      } else {
        moveUp.fadeOut(600);
        moveUpBlock.css({
          'background-color': 'transparent'
        });
      }
    };
    moveUp.click(function () {
      html.scrollTop({
        scrollY: 0
      }, 0);
      return false;
    });
    moveUpBlock.click(function () {
      html.scrollTop({
        scrollY: 0
      }, 0);
      return false;
    });
  });
};

/***/ }),

/***/ "./asset/js/profile.js":
/*!*****************************!*\
  !*** ./asset/js/profile.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.promise.js */ "./node_modules/core-js/modules/es.promise.js");
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.array.from.js */ "./node_modules/core-js/modules/es.array.from.js");
/* harmony import */ var core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
/* harmony import */ var bootstrap_dist_js_bootstrap_esm_min_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! bootstrap/dist/js/bootstrap.esm.min.js */ "./node_modules/bootstrap/dist/js/bootstrap.esm.min.js");










__webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
// require('bootstrap-autohide-navbar');

//require('masonry-layout');
__webpack_require__(/*! ../scss/profile.scss */ "./asset/scss/profile.scss");
__webpack_require__(/*! ../css/profile.css */ "./asset/css/profile.css");

//import('./masonry_init.js');
//import('../css/app.css');
__webpack_require__.e(/*! import() */ "asset_css_navbar_css").then(__webpack_require__.bind(__webpack_require__, /*! ../css/navbar.css */ "./asset/css/navbar.css"));

//require('../css/likeMasonryCart.css');
__webpack_require__(/*! ../fontawesome-pro/js/all.min */ "./asset/fontawesome-pro/js/all.min.js");
// require('./auto_hiding_navbar_init');
// require('./bootstrap-tags-input-init');
// require('./cart.js');
//require('./multistep_form');
__webpack_require__(/*! ./tinymce_init */ "./asset/js/tinymce_init.js");
__webpack_require__(/*! ./move_up */ "./asset/js/move_up.js");
//require('./masonry_init');
// require('./cols_per_row');
// require('./add-collection-widget');
__webpack_require__(/*! ./full_screen */ "./asset/js/full_screen.js");
Array.from(document.querySelectorAll('.toast')).forEach(function (toastNode) {
  return new bootstrap_dist_js_bootstrap_esm_min_js__WEBPACK_IMPORTED_MODULE_9__.Toast(toastNode).show();
});

/***/ }),

/***/ "./asset/js/tinymce_init.js":
/*!**********************************!*\
  !*** ./asset/js/tinymce_init.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");
__webpack_require__(/*! core-js/modules/es.date.to-string.js */ "./node_modules/core-js/modules/es.date.to-string.js");
// Creates links to the TinyMCE
// https://www.youtube.com/watch?v=fOCw15bpbSw
//

var tinymce = __webpack_require__(/*! tinymce */ "./node_modules/tinymce/tinymce.js");
__webpack_require__(/*! tinymce/skins/ui/oxide/skin.css */ "./node_modules/tinymce/skins/ui/oxide/skin.css");
__webpack_require__(/*! tinymce/themes/silver/index */ "./node_modules/tinymce/themes/silver/index.js");
__webpack_require__(/*! tinymce/plugins/image */ "./node_modules/tinymce/plugins/image/index.js");
var form = document.querySelector('#object');
//let form = $('#object').filter('form');
//console.dir(document.documentElement); console.log(form.dataset.objectId);
if (form !== undefined) {
  tinymce.init({
    selector: '.reader',
    plugins: 'image',
    toolbar: 'undo redo | link image',
    automatic_uploads: true,
    images_upload_url: '/attachment/' + form.dataset.name + form.dataset.objectId,
    file_picker_types: 'image',
    file_picker_callback: function file_picker_callback(cb, value, meta) {
      var input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'image/*');
      input.onchange = function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function () {
          var id = 'blobid' + new Date().getTime();
          var blobCache = tinymce.activeEditor.editorUpload.blobCache;
          var base64 = reader.result.split(',')[1];
          var blobInfo = blobCache.create(id, file, base64);
          blobCache.add(blobInfo);

          /* call the callback and populate the Title field with the file name */
          cb(blobInfo.blobUri(), {
            title: file.name
          });
        };
        reader.readAsDataURL(file);
      };
      input.click();
    }
  });
}

/***/ }),

/***/ "./asset/css/profile.css":
/*!*******************************!*\
  !*** ./asset/css/profile.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./asset/scss/profile.scss":
/*!*********************************!*\
  !*** ./asset/scss/profile.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/ensure chunk */
/******/ 	(() => {
/******/ 		__webpack_require__.f = {};
/******/ 		// This file contains only the entry chunk.
/******/ 		// The chunk loading function for additional chunks
/******/ 		__webpack_require__.e = (chunkId) => {
/******/ 			return Promise.all(Object.keys(__webpack_require__.f).reduce((promises, key) => {
/******/ 				__webpack_require__.f[key](chunkId, promises);
/******/ 				return promises;
/******/ 			}, []));
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/get javascript chunk filename */
/******/ 	(() => {
/******/ 		// This function allow to reference async chunks
/******/ 		__webpack_require__.u = (chunkId) => {
/******/ 			// return url for filenames based on template
/******/ 			return "" + chunkId + ".js";
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/get mini-css chunk filename */
/******/ 	(() => {
/******/ 		// This function allow to reference all chunks
/******/ 		__webpack_require__.miniCssF = (chunkId) => {
/******/ 			// return url for filenames based on template
/******/ 			return "" + chunkId + ".css";
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	(() => {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/load script */
/******/ 	(() => {
/******/ 		var inProgress = {};
/******/ 		var dataWebpackPrefix = "isponsor:";
/******/ 		// loadScript function to load a script via script tag
/******/ 		__webpack_require__.l = (url, done, key, chunkId) => {
/******/ 			if(inProgress[url]) { inProgress[url].push(done); return; }
/******/ 			var script, needAttach;
/******/ 			if(key !== undefined) {
/******/ 				var scripts = document.getElementsByTagName("script");
/******/ 				for(var i = 0; i < scripts.length; i++) {
/******/ 					var s = scripts[i];
/******/ 					if(s.getAttribute("src") == url || s.getAttribute("data-webpack") == dataWebpackPrefix + key) { script = s; break; }
/******/ 				}
/******/ 			}
/******/ 			if(!script) {
/******/ 				needAttach = true;
/******/ 				script = document.createElement('script');
/******/ 		
/******/ 				script.charset = 'utf-8';
/******/ 				script.timeout = 120;
/******/ 				if (__webpack_require__.nc) {
/******/ 					script.setAttribute("nonce", __webpack_require__.nc);
/******/ 				}
/******/ 				script.setAttribute("data-webpack", dataWebpackPrefix + key);
/******/ 				script.src = url;
/******/ 			}
/******/ 			inProgress[url] = [done];
/******/ 			var onScriptComplete = (prev, event) => {
/******/ 				// avoid mem leaks in IE.
/******/ 				script.onerror = script.onload = null;
/******/ 				clearTimeout(timeout);
/******/ 				var doneFns = inProgress[url];
/******/ 				delete inProgress[url];
/******/ 				script.parentNode && script.parentNode.removeChild(script);
/******/ 				doneFns && doneFns.forEach((fn) => (fn(event)));
/******/ 				if(prev) return prev(event);
/******/ 			}
/******/ 			var timeout = setTimeout(onScriptComplete.bind(null, undefined, { type: 'timeout', target: script }), 120000);
/******/ 			script.onerror = onScriptComplete.bind(null, script.onerror);
/******/ 			script.onload = onScriptComplete.bind(null, script.onload);
/******/ 			needAttach && document.head.appendChild(script);
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/publicPath */
/******/ 	(() => {
/******/ 		__webpack_require__.p = "/build/";
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/css loading */
/******/ 	(() => {
/******/ 		var createStylesheet = (chunkId, fullhref, resolve, reject) => {
/******/ 			var linkTag = document.createElement("link");
/******/ 		
/******/ 			linkTag.rel = "stylesheet";
/******/ 			linkTag.type = "text/css";
/******/ 			var onLinkComplete = (event) => {
/******/ 				// avoid mem leaks.
/******/ 				linkTag.onerror = linkTag.onload = null;
/******/ 				if (event.type === 'load') {
/******/ 					resolve();
/******/ 				} else {
/******/ 					var errorType = event && (event.type === 'load' ? 'missing' : event.type);
/******/ 					var realHref = event && event.target && event.target.href || fullhref;
/******/ 					var err = new Error("Loading CSS chunk " + chunkId + " failed.\n(" + realHref + ")");
/******/ 					err.code = "CSS_CHUNK_LOAD_FAILED";
/******/ 					err.type = errorType;
/******/ 					err.request = realHref;
/******/ 					linkTag.parentNode.removeChild(linkTag)
/******/ 					reject(err);
/******/ 				}
/******/ 			}
/******/ 			linkTag.onerror = linkTag.onload = onLinkComplete;
/******/ 			linkTag.href = fullhref;
/******/ 		
/******/ 			document.head.appendChild(linkTag);
/******/ 			return linkTag;
/******/ 		};
/******/ 		var findStylesheet = (href, fullhref) => {
/******/ 			var existingLinkTags = document.getElementsByTagName("link");
/******/ 			for(var i = 0; i < existingLinkTags.length; i++) {
/******/ 				var tag = existingLinkTags[i];
/******/ 				var dataHref = tag.getAttribute("data-href") || tag.getAttribute("href");
/******/ 				if(tag.rel === "stylesheet" && (dataHref === href || dataHref === fullhref)) return tag;
/******/ 			}
/******/ 			var existingStyleTags = document.getElementsByTagName("style");
/******/ 			for(var i = 0; i < existingStyleTags.length; i++) {
/******/ 				var tag = existingStyleTags[i];
/******/ 				var dataHref = tag.getAttribute("data-href");
/******/ 				if(dataHref === href || dataHref === fullhref) return tag;
/******/ 			}
/******/ 		};
/******/ 		var loadStylesheet = (chunkId) => {
/******/ 			return new Promise((resolve, reject) => {
/******/ 				var href = __webpack_require__.miniCssF(chunkId);
/******/ 				var fullhref = __webpack_require__.p + href;
/******/ 				if(findStylesheet(href, fullhref)) return resolve();
/******/ 				createStylesheet(chunkId, fullhref, resolve, reject);
/******/ 			});
/******/ 		}
/******/ 		// object to store loaded CSS chunks
/******/ 		var installedCssChunks = {
/******/ 			"profile": 0
/******/ 		};
/******/ 		
/******/ 		__webpack_require__.f.miniCss = (chunkId, promises) => {
/******/ 			var cssChunks = {"asset_css_navbar_css":1};
/******/ 			if(installedCssChunks[chunkId]) promises.push(installedCssChunks[chunkId]);
/******/ 			else if(installedCssChunks[chunkId] !== 0 && cssChunks[chunkId]) {
/******/ 				promises.push(installedCssChunks[chunkId] = loadStylesheet(chunkId).then(() => {
/******/ 					installedCssChunks[chunkId] = 0;
/******/ 				}, (e) => {
/******/ 					delete installedCssChunks[chunkId];
/******/ 					throw e;
/******/ 				}));
/******/ 			}
/******/ 		};
/******/ 		
/******/ 		// no hmr
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"profile": 0,
/******/ 			"vendors-node_modules_tinymce_skins_ui_oxide_content_min_css-node_modules_tinymce_skins_ui_oxi-29c70f": 0
/******/ 		};
/******/ 		
/******/ 		__webpack_require__.f.j = (chunkId, promises) => {
/******/ 				// JSONP chunk loading for javascript
/******/ 				var installedChunkData = __webpack_require__.o(installedChunks, chunkId) ? installedChunks[chunkId] : undefined;
/******/ 				if(installedChunkData !== 0) { // 0 means "already installed".
/******/ 		
/******/ 					// a Promise means "currently loading".
/******/ 					if(installedChunkData) {
/******/ 						promises.push(installedChunkData[2]);
/******/ 					} else {
/******/ 						if("vendors-node_modules_tinymce_skins_ui_oxide_content_min_css-node_modules_tinymce_skins_ui_oxi-29c70f" != chunkId) {
/******/ 							// setup Promise in chunk cache
/******/ 							var promise = new Promise((resolve, reject) => (installedChunkData = installedChunks[chunkId] = [resolve, reject]));
/******/ 							promises.push(installedChunkData[2] = promise);
/******/ 		
/******/ 							// start chunk loading
/******/ 							var url = __webpack_require__.p + __webpack_require__.u(chunkId);
/******/ 							// create error before stack unwound to get useful stacktrace later
/******/ 							var error = new Error();
/******/ 							var loadingEnded = (event) => {
/******/ 								if(__webpack_require__.o(installedChunks, chunkId)) {
/******/ 									installedChunkData = installedChunks[chunkId];
/******/ 									if(installedChunkData !== 0) installedChunks[chunkId] = undefined;
/******/ 									if(installedChunkData) {
/******/ 										var errorType = event && (event.type === 'load' ? 'missing' : event.type);
/******/ 										var realSrc = event && event.target && event.target.src;
/******/ 										error.message = 'Loading chunk ' + chunkId + ' failed.\n(' + errorType + ': ' + realSrc + ')';
/******/ 										error.name = 'ChunkLoadError';
/******/ 										error.type = errorType;
/******/ 										error.request = realSrc;
/******/ 										installedChunkData[1](error);
/******/ 									}
/******/ 								}
/******/ 							};
/******/ 							__webpack_require__.l(url, loadingEnded, "chunk-" + chunkId, chunkId);
/******/ 						} else installedChunks[chunkId] = 0;
/******/ 					}
/******/ 				}
/******/ 		};
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkisponsor"] = self["webpackChunkisponsor"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["vendors-node_modules_popperjs_core_lib_index_js-node_modules_core-js_internals_a-constructor_-e86f9d","vendors-node_modules_bootstrap_dist_js_bootstrap_esm_js","vendors-node_modules_core-js_modules_es_array_concat_js-node_modules_core-js_modules_es_array-204162","vendors-node_modules_bootstrap_dist_js_bootstrap_esm_min_js","vendors-node_modules_masonry-layout_masonry_js-node_modules_js-cookie_dist_js_cookie_mjs","vendors-node_modules_tinymce_skins_ui_oxide_content_min_css-node_modules_tinymce_skins_ui_oxi-29c70f","vendors-node_modules_tinymce_skins_ui_oxide_skin_css-node_modules_tinymce_plugins_image_index-115691","asset_fontawesome-pro_js_all_min_js"], () => (__webpack_require__("./asset/js/profile.js")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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Y2VzIjpbIndlYnBhY2s6Ly9pc3BvbnNvci8uL2Fzc2V0L2pzL2Z1bGxfc2NyZWVuLmpzIiwid2VicGFjazovL2lzcG9uc29yLy4vYXNzZXQvanMvbW92ZV91cC5qcyIsIndlYnBhY2s6Ly9pc3BvbnNvci8uL2Fzc2V0L2pzL3Byb2ZpbGUuanMiLCJ3ZWJwYWNrOi8vaXNwb25zb3IvLi9hc3NldC9qcy90aW55bWNlX2luaXQuanMiLCJ3ZWJwYWNrOi8vaXNwb25zb3IvLi9hc3NldC9jc3MvcHJvZmlsZS5jc3M/OWIzYiIsIndlYnBhY2s6Ly9pc3BvbnNvci8uL2Fzc2V0L3Njc3MvcHJvZmlsZS5zY3NzIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svYm9vdHN0cmFwIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9jaHVuayBsb2FkZWQiLCJ3ZWJwYWNrOi8vaXNwb25zb3Ivd2VicGFjay9ydW50aW1lL2NvbXBhdCBnZXQgZGVmYXVsdCBleHBvcnQiLCJ3ZWJwYWNrOi8vaXNwb25zb3Ivd2VicGFjay9ydW50aW1lL2RlZmluZSBwcm9wZXJ0eSBnZXR0ZXJzIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9lbnN1cmUgY2h1bmsiLCJ3ZWJwYWNrOi8vaXNwb25zb3Ivd2VicGFjay9ydW50aW1lL2dldCBqYXZhc2NyaXB0IGNodW5rIGZpbGVuYW1lIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9nZXQgbWluaS1jc3MgY2h1bmsgZmlsZW5hbWUiLCJ3ZWJwYWNrOi8vaXNwb25zb3Ivd2VicGFjay9ydW50aW1lL2dsb2JhbCIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL3J1bnRpbWUvaGFzT3duUHJvcGVydHkgc2hvcnRoYW5kIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9sb2FkIHNjcmlwdCIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL3J1bnRpbWUvbWFrZSBuYW1lc3BhY2Ugb2JqZWN0Iiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9wdWJsaWNQYXRoIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9jc3MgbG9hZGluZyIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL3J1bnRpbWUvanNvbnAgY2h1bmsgbG9hZGluZyIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL2JlZm9yZS1zdGFydHVwIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svc3RhcnR1cCIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL2FmdGVyLXN0YXJ0dXAiXSwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IENvb2tpZXMgZnJvbSAnanMtY29va2llJztcclxuaW1wb3J0IE1hc29ucnkgZnJvbSAnbWFzb25yeS1sYXlvdXQnO1xyXG5cclxuLy9sZXQgZ3JpZCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNtYXNvbnJ5LWdyaWQnKTtcclxubGV0IGZ1bGxTY3JlZW5CdXR0b24gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjZnVsbC1zY3JlZW4nKTtcclxubGV0IG1hc29ucnlHcmlkID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI21hc29ucnktZ3JpZCcpO1xyXG5cclxuaWYgKGZ1bGxTY3JlZW5CdXR0b24gIT0gbnVsbCAmJiBtYXNvbnJ5R3JpZCAhPSBudWxsKSB7XHJcblxyXG4gICAgICAgIGxldCAkaHRtbCA9ICQoJ2h0bWwnKTtcclxuICAgICAgICBsZXQgJGhpZGVBcnJheSA9ICQoJyNiMSwgI2IyLCAjaGVhZGVyLCAjcDEsICNwMicpO1xyXG4gICAgICAgIGxldCAkcGFuZWwgPSAkKCcjcGFuZWwnKS5maWx0ZXIoJ2RpdicpO1xyXG4gICAgICAgIGxldCAkY29udGVudEJsb2NrID0gJCgnI2IzJykuZmlsdGVyKCdhcnRpY2xlJyk7XHJcbiAgICAgICAgbGV0ICRhc2lkZVJpZ2h0UGFuZWwgPSAkKCcjYjQnKS5maWx0ZXIoJ2RpdicpO1xyXG4gICAgICAgIGxldCAkZnVsbFNjcmVlbkJ1dHRvbiA9ICQoJyNmdWxsLXNjcmVlbicpLmZpbHRlcignYnV0dG9uJyk7XHJcbiAgICAgICAgbGV0ICRmdWxsU2NyZWVuTWVzc2FnZSA9ICQoJyNmdWxsc2NyZWVuLW1lc3NhZ2UnKS5maWx0ZXIoJ2RpdicpO1xyXG4gICAgICAgIGxldCAkZnVsbFNjcmVlbkljb24gPSAkKCcjZmEtZnVsbC1zY3JlZW4nKS5maWx0ZXIoJ2knKTtcclxuICAgICAgICBsZXQgJGZ1bGxTY3JJY29uQ2xhc3MgPSAnZmEtYXJyb3dzJztcclxuICAgICAgICBsZXQgJGZ1bGxTY3JJY29uUHJlc3MgPSAnZmEtY29tcHJlc3MtYXJyb3dzLWFsdCc7XHJcbiAgICAgICAgbGV0ICR3aWR0aCA9IDEwMCAqICRjb250ZW50QmxvY2sud2lkdGgoKSAvICRjb250ZW50QmxvY2sucGFyZW50KCkud2lkdGgoKTtcclxuICAgICAgICBsZXQgJG1hc29ucnlCcmljayA9ICQoJy5tYXNvbnJ5LWJyaWNrJykuZmlsdGVyKCdkaXYnKTtcclxuICAgICAgICBsZXQgJG1hc29ucnlHcmlkID0gJCgnI21hc29ucnktZ3JpZDpmaXJzdCcpLmZpbHRlcignZGl2Jyk7XHJcbiAgICAgICAgaWYgKCRtYXNvbnJ5R3JpZC5sZW5ndGggIT09IDApIHtcclxuICAgICAgICAgICAgdmFyICRtYXNvbnJ5ID0gbmV3IE1hc29ucnkoJyNtYXNvbnJ5LWdyaWQnLCB7XHJcbiAgICAgICAgICAgICAgICAvLyBvcHRpb25zLi4uXHJcbiAgICAgICAgICAgICAgICBpdGVtU2VsZWN0b3I6ICcubWFzb25yeS1icmljaycsXHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgICAkbWFzb25yeS5sYXlvdXQoKTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIGlmIChDb29raWVzLmdldCgnc2NyZWVuJykpIHtcclxuICAgICAgICAgICAgJG1hc29ucnlCcmljay5jc3MoJ3dpZHRoJywgQ29va2llcy5nZXQoJ3NjcmVlbicpKTtcclxuICAgICAgICAgICAgbWFzb25yeUxheW91dCgpO1xyXG4gICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgICRtYXNvbnJ5QnJpY2suY3NzKCd3aWR0aCcsICcyNSUnKTtcclxuICAgICAgICAgICAgbWFzb25yeUxheW91dCgpO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJGZ1bGxTY3JlZW5CdXR0b24uY2xpY2soZnVuY3Rpb24gKCkge1xyXG5cclxuICAgICAgICAgICAgaWYgKE1hdGgucm91bmQoJHdpZHRoKSA9PT0gMTAwKSB7XHJcblxyXG4gICAgICAgICAgICAgICAgJGhpZGVBcnJheS5zaG93KCk7XHJcbiAgICAgICAgICAgICAgICAkY29udGVudEJsb2NrLnJlbW92ZUNsYXNzKCdjb2wtbGctMTIgY29sLXNtLTEyIGNvbC1tZC0xMicpLmFkZENsYXNzKCdjb2wtbGctOCBjb2wtc20tNiBjb2wtbWQtOCcpO1xyXG4gICAgICAgICAgICAgICAgJHBhbmVsLnJlbW92ZUNsYXNzKCdjb2wtc20tMTIgY29sLW1kLTEyIGNvbC1sZy0xMicpLmFkZENsYXNzKCdjb2wtc20tNiBjb2wtbWQtOCBjb2wtbGctOCcpO1xyXG5cclxuICAgICAgICAgICAgICAgICRhc2lkZVJpZ2h0UGFuZWxcclxuICAgICAgICAgICAgICAgICAgICAuY3NzKCdiYWNrZ3JvdW5kLWNvbG9yJywgJ3RyYW5zcGFyZW50JylcclxuICAgICAgICAgICAgICAgICAgICAudG9nZ2xlQ2xhc3MoJ2Fic29sdXRlcGFuZWwnKVxyXG4gICAgICAgICAgICAgICAgICAgIC5jc3MoJ3JpZ2h0JywgJ2luaGVyaXQhaW1wb3J0YW50JylcclxuICAgICAgICAgICAgICAgICAgICAudW5iaW5kKCdjbGljaycpO1xyXG5cclxuICAgICAgICAgICAgICAgIGZ1bGxTY3JlZW5JY29uKCk7XHJcbiAgICAgICAgICAgICAgICAkd2lkdGggPSAwO1xyXG4gICAgICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAgICAgJGNvbnRlbnRCbG9jay5yZW1vdmVDbGFzcygnY29sLWxnLTggY29sLXNtLTYgY29sLW1kLTgnKS5hZGRDbGFzcygnY29sLWxnLTEyIGNvbC1zbS0xMiBjb2wtbWQtMTInKTtcclxuICAgICAgICAgICAgICAgICRwYW5lbC5yZW1vdmVDbGFzcygnY29sLXNtLTYgY29sLW1kLTggY29sLWxnLTgnKS5hZGRDbGFzcygnY29sLXNtLTEyIGNvbC1tZC0xMiBjb2wtbGctMTInKTtcclxuICAgICAgICAgICAgICAgICRoaWRlQXJyYXkuaGlkZSgpO1xyXG4gICAgICAgICAgICAgICAgJGFzaWRlUmlnaHRQYW5lbFxyXG4gICAgICAgICAgICAgICAgICAgIC50b2dnbGVDbGFzcygnYWJzb2x1dGVwYW5lbCcpXHJcbiAgICAgICAgICAgICAgICAgICAgLnRvZ2dsZShmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICRhc2lkZVJpZ2h0UGFuZWwuYW5pbWF0ZSh7cmlnaHQ6ICctMTY1cHgnfSwgNTAwKTtcclxuICAgICAgICAgICAgICAgICAgICB9LCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICRhc2lkZVJpZ2h0UGFuZWwuYW5pbWF0ZSh7cmlnaHQ6IDB9LCA1MDApO1xyXG4gICAgICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuXHJcbiAgICAgICAgICAgICAgICAkYXNpZGVSaWdodFBhbmVsXHJcbiAgICAgICAgICAgICAgICAgICAgLmNzcygnYmFja2dyb3VuZC1jb2xvcicsICd0cmFuc3BhcmVudCcpXHJcbiAgICAgICAgICAgICAgICAgICAgLnRvZ2dsZUNsYXNzKCdhYnNvbHV0ZXBhbmVsJylcclxuICAgICAgICAgICAgICAgICAgICAuY3NzKCdyaWdodCcsICdpbmhlcml0IWltcG9ydGFudCcpXHJcbiAgICAgICAgICAgICAgICAgICAgLnVuYmluZCgnY2xpY2snKTtcclxuXHJcbiAgICAgICAgICAgICAgICBmdWxsU2NyZWVuSWNvbigpO1xyXG5cclxuICAgICAgICAgICAgICAgICR3aWR0aCA9IDEwMDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgbWFzb25yeUxheW91dCgpO1xyXG5cclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgJGZ1bGxTY3JlZW5CdXR0b24ub24oJ3Nob3duLmJzLm1vZGFsJywgZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICAkKCcjc2F2ZUZ1bGxTY3JlZW4nKS50cmlnZ2VyKCdmb2N1cycpXHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICRodG1sLmtleXByZXNzKGZ1bmN0aW9uIChlKSB7XHJcblxyXG4gICAgICAgICAgICBpZiAoZS5rZXlDb2RlID09PSAyNyAmJiAkd2lkdGggPT09IDEwMCApIHtcclxuICAgICAgICAgICAgICAgICRmdWxsU2NyZWVuTWVzc2FnZS5tb2RhbCgpO1xyXG4gICAgICAgICAgICAgICAgJGhpZGVBcnJheS5zaG93KCk7XHJcbiAgICAgICAgICAgICAgICAkY29udGVudEJsb2NrLnJlbW92ZUNsYXNzKCdjb2wtbGctMTIgY29sLXNtLTEyIGNvbC1tZC0xMicpLmFkZENsYXNzKCdjb2wtbGctOCBjb2wtc20tNiBjb2wtbWQtOCcpO1xyXG5cclxuICAgICAgICAgICAgICAgIGFzaWRlUmlnaHRQYW5lbCgpO1xyXG4gICAgICAgICAgICAgICAgZnVsbFNjcmVlbkljb24oKTtcclxuXHJcbiAgICAgICAgICAgICAgICBtYXNvbnJ5TGF5b3V0KCk7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICR3aWR0aCA9IDA7XHJcbiAgICAgICAgfSk7XHJcblxyXG5cclxuICAgICAgICBmdW5jdGlvbiBmdWxsU2NyZWVuSWNvbigpIHtcclxuICAgICAgICAgICAgJGZ1bGxTY3JlZW5JY29uLnRvZ2dsZUNsYXNzKCRmdWxsU2NySWNvbkNsYXNzLCAkZnVsbFNjckljb25QcmVzcyk7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBmdW5jdGlvbiBhc2lkZVJpZ2h0UGFuZWwoKSB7XHJcbiAgICAgICAgICAgICRhc2lkZVJpZ2h0UGFuZWxcclxuICAgICAgICAgICAgICAgIC5jc3MoJ2JhY2tncm91bmQtY29sb3InLCAndHJhbnNwYXJlbnQnKVxyXG4gICAgICAgICAgICAgICAgLnRvZ2dsZUNsYXNzKCdhYnNvbHV0ZXBhbmVsJylcclxuICAgICAgICAgICAgICAgIC5jc3MoJ3JpZ2h0JywgJ2luaGVyaXQhaW1wb3J0YW50JylcclxuICAgICAgICAgICAgICAgIC51bmJpbmQoJ2NsaWNrJyk7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBmdW5jdGlvbiBtYXNvbnJ5TGF5b3V0KCkge1xyXG4gICAgICAgICAgICBpZiAoJG1hc29ucnlHcmlkLmxlbmd0aCAhPT0gMCkge1xyXG4gICAgICAgICAgICAgICAgJG1hc29ucnkubGF5b3V0KCk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbn1cclxuIiwid2luZG93Lm9ubG9hZCA9IGZ1bmN0aW9uICgpIHtcbndpbmRvdy5hZGRFdmVudExpc3RlbmVyKCdsb2FkJywgKGV2ZW50KSA9PiB7XG4gICAgY29uc3QgbW92ZVVwID0gZG9jdW1lbnQuZGl2LnF1ZXJ5U2VsZWN0b3JBbGwoXCIjbW92ZV91cFwiKVxuICAgIGNvbnN0IG1vdmVVcEJsb2NrID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChcIiNiMVwiKVxuXG4gICAgd2luZG93LnNjcm9sbCA9IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgaWYgKHRoaXMuc2Nyb2xsWSA+IDQwMCkge1xuICAgICAgICAgICAgbW92ZVVwLmZhZGVJbig2MDApO1xuICAgICAgICAgICAgbW92ZVVwQmxvY2suY3NzKHsnYmFja2dyb3VuZC1jb2xvcic6ICcjY2ZjZmNmJ30pO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgbW92ZVVwLmZhZGVPdXQoNjAwKTtcbiAgICAgICAgICAgIG1vdmVVcEJsb2NrLmNzcyh7J2JhY2tncm91bmQtY29sb3InOiAndHJhbnNwYXJlbnQnfSk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBtb3ZlVXAuY2xpY2soZnVuY3Rpb24gKCkge1xuICAgICAgICBodG1sLnNjcm9sbFRvcCh7XG4gICAgICAgICAgICBzY3JvbGxZOiAwXG4gICAgICAgIH0sIDApO1xuICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgfSk7XG4gICAgbW92ZVVwQmxvY2suY2xpY2soZnVuY3Rpb24gKCkge1xuICAgICAgICBodG1sLnNjcm9sbFRvcCh7XG4gICAgICAgICAgICBzY3JvbGxZOiAwXG4gICAgICAgIH0sIDApO1xuICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgfSk7XG59KVxufVxuXG5cblxuXG5cbiIsImltcG9ydCAnYm9vdHN0cmFwJ1xyXG5pbXBvcnQgeyBUb2FzdCB9IGZyb20gJ2Jvb3RzdHJhcC9kaXN0L2pzL2Jvb3RzdHJhcC5lc20ubWluLmpzJ1xyXG5yZXF1aXJlKCdib290c3RyYXAnKTtcclxuLy8gcmVxdWlyZSgnYm9vdHN0cmFwLWF1dG9oaWRlLW5hdmJhcicpO1xyXG5cclxuXHJcbi8vcmVxdWlyZSgnbWFzb25yeS1sYXlvdXQnKTtcclxucmVxdWlyZSgnLi4vc2Nzcy9wcm9maWxlLnNjc3MnKTtcclxucmVxdWlyZSgnLi4vY3NzL3Byb2ZpbGUuY3NzJyk7XHJcblxyXG5cclxuLy9pbXBvcnQoJy4vbWFzb25yeV9pbml0LmpzJyk7XHJcbi8vaW1wb3J0KCcuLi9jc3MvYXBwLmNzcycpO1xyXG5pbXBvcnQoJy4uL2Nzcy9uYXZiYXIuY3NzJyk7XHJcblxyXG5cclxuLy9yZXF1aXJlKCcuLi9jc3MvbGlrZU1hc29ucnlDYXJ0LmNzcycpO1xyXG5yZXF1aXJlKCcuLi9mb250YXdlc29tZS1wcm8vanMvYWxsLm1pbicpO1xyXG4vLyByZXF1aXJlKCcuL2F1dG9faGlkaW5nX25hdmJhcl9pbml0Jyk7XHJcbi8vIHJlcXVpcmUoJy4vYm9vdHN0cmFwLXRhZ3MtaW5wdXQtaW5pdCcpO1xyXG4vLyByZXF1aXJlKCcuL2NhcnQuanMnKTtcclxuLy9yZXF1aXJlKCcuL211bHRpc3RlcF9mb3JtJyk7XHJcbnJlcXVpcmUoJy4vdGlueW1jZV9pbml0Jyk7XHJcbnJlcXVpcmUoJy4vbW92ZV91cCcpO1xyXG4vL3JlcXVpcmUoJy4vbWFzb25yeV9pbml0Jyk7XHJcbi8vIHJlcXVpcmUoJy4vY29sc19wZXJfcm93Jyk7XHJcbi8vIHJlcXVpcmUoJy4vYWRkLWNvbGxlY3Rpb24td2lkZ2V0Jyk7XHJcbnJlcXVpcmUoJy4vZnVsbF9zY3JlZW4nKTtcclxuXHJcblxyXG5BcnJheS5mcm9tKGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy50b2FzdCcpKVxyXG4gICAgLmZvckVhY2godG9hc3ROb2RlID0+IG5ldyBUb2FzdCh0b2FzdE5vZGUpLnNob3coKSk7XHJcbiIsIi8vIENyZWF0ZXMgbGlua3MgdG8gdGhlIFRpbnlNQ0Vcbi8vIGh0dHBzOi8vd3d3LnlvdXR1YmUuY29tL3dhdGNoP3Y9Zk9DdzE1YnBiU3dcbi8vXG5cbmxldCB0aW55bWNlID0gcmVxdWlyZSgndGlueW1jZScpO1xucmVxdWlyZSgndGlueW1jZS9za2lucy91aS9veGlkZS9za2luLmNzcycpO1xucmVxdWlyZSgndGlueW1jZS90aGVtZXMvc2lsdmVyL2luZGV4Jyk7XG5yZXF1aXJlKCd0aW55bWNlL3BsdWdpbnMvaW1hZ2UnKTtcbmxldCBmb3JtID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI29iamVjdCcpO1xuLy9sZXQgZm9ybSA9ICQoJyNvYmplY3QnKS5maWx0ZXIoJ2Zvcm0nKTtcbi8vY29uc29sZS5kaXIoZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KTsgY29uc29sZS5sb2coZm9ybS5kYXRhc2V0Lm9iamVjdElkKTtcbmlmIChmb3JtICE9PSB1bmRlZmluZWQpIHtcbiAgICB0aW55bWNlLmluaXQoe1xuICAgICAgICBzZWxlY3RvcjogJy5yZWFkZXInLFxuICAgICAgICBwbHVnaW5zOiAnaW1hZ2UnLFxuICAgICAgICB0b29sYmFyOiAndW5kbyByZWRvIHwgbGluayBpbWFnZScsXG4gICAgICAgIGF1dG9tYXRpY191cGxvYWRzOiB0cnVlLFxuICAgICAgICBpbWFnZXNfdXBsb2FkX3VybDogJy9hdHRhY2htZW50LycgKyBmb3JtLmRhdGFzZXQubmFtZSArIGZvcm0uZGF0YXNldC5vYmplY3RJZCxcbiAgICAgICAgZmlsZV9waWNrZXJfdHlwZXM6ICdpbWFnZScsXG4gICAgICAgIGZpbGVfcGlja2VyX2NhbGxiYWNrOiBmdW5jdGlvbiAoY2IsIHZhbHVlLCBtZXRhKSB7XG4gICAgICAgICAgICBsZXQgaW5wdXQgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdpbnB1dCcpO1xuICAgICAgICAgICAgaW5wdXQuc2V0QXR0cmlidXRlKCd0eXBlJywgJ2ZpbGUnKTtcbiAgICAgICAgICAgIGlucHV0LnNldEF0dHJpYnV0ZSgnYWNjZXB0JywgJ2ltYWdlLyonKTtcbiAgICAgICAgICAgIGlucHV0Lm9uY2hhbmdlID0gZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIGxldCBmaWxlID0gdGhpcy5maWxlc1swXTtcblxuICAgICAgICAgICAgICAgIGxldCByZWFkZXIgPSBuZXcgRmlsZVJlYWRlcigpO1xuICAgICAgICAgICAgICAgIHJlYWRlci5vbmxvYWQgPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgIGxldCBpZCA9ICdibG9iaWQnICsgKG5ldyBEYXRlKCkpLmdldFRpbWUoKTtcbiAgICAgICAgICAgICAgICAgICAgbGV0IGJsb2JDYWNoZSA9IHRpbnltY2UuYWN0aXZlRWRpdG9yLmVkaXRvclVwbG9hZC5ibG9iQ2FjaGU7XG4gICAgICAgICAgICAgICAgICAgIGxldCBiYXNlNjQgPSByZWFkZXIucmVzdWx0LnNwbGl0KCcsJylbMV07XG4gICAgICAgICAgICAgICAgICAgIGxldCBibG9iSW5mbyA9IGJsb2JDYWNoZS5jcmVhdGUoaWQsIGZpbGUsIGJhc2U2NCk7XG4gICAgICAgICAgICAgICAgICAgIGJsb2JDYWNoZS5hZGQoYmxvYkluZm8pO1xuXG4gICAgICAgICAgICAgICAgICAgIC8qIGNhbGwgdGhlIGNhbGxiYWNrIGFuZCBwb3B1bGF0ZSB0aGUgVGl0bGUgZmllbGQgd2l0aCB0aGUgZmlsZSBuYW1lICovXG4gICAgICAgICAgICAgICAgICAgIGNiKGJsb2JJbmZvLmJsb2JVcmkoKSwge3RpdGxlOiBmaWxlLm5hbWV9KTtcbiAgICAgICAgICAgICAgICB9O1xuICAgICAgICAgICAgICAgIHJlYWRlci5yZWFkQXNEYXRhVVJMKGZpbGUpO1xuICAgICAgICAgICAgfTtcblxuICAgICAgICAgICAgaW5wdXQuY2xpY2soKTtcbiAgICAgICAgfVxuICAgIH0pO1xufVxuIiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307IiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307IiwiLy8gVGhlIG1vZHVsZSBjYWNoZVxudmFyIF9fd2VicGFja19tb2R1bGVfY2FjaGVfXyA9IHt9O1xuXG4vLyBUaGUgcmVxdWlyZSBmdW5jdGlvblxuZnVuY3Rpb24gX193ZWJwYWNrX3JlcXVpcmVfXyhtb2R1bGVJZCkge1xuXHQvLyBDaGVjayBpZiBtb2R1bGUgaXMgaW4gY2FjaGVcblx0dmFyIGNhY2hlZE1vZHVsZSA9IF9fd2VicGFja19tb2R1bGVfY2FjaGVfX1ttb2R1bGVJZF07XG5cdGlmIChjYWNoZWRNb2R1bGUgIT09IHVuZGVmaW5lZCkge1xuXHRcdHJldHVybiBjYWNoZWRNb2R1bGUuZXhwb3J0cztcblx0fVxuXHQvLyBDcmVhdGUgYSBuZXcgbW9kdWxlIChhbmQgcHV0IGl0IGludG8gdGhlIGNhY2hlKVxuXHR2YXIgbW9kdWxlID0gX193ZWJwYWNrX21vZHVsZV9jYWNoZV9fW21vZHVsZUlkXSA9IHtcblx0XHQvLyBubyBtb2R1bGUuaWQgbmVlZGVkXG5cdFx0Ly8gbm8gbW9kdWxlLmxvYWRlZCBuZWVkZWRcblx0XHRleHBvcnRzOiB7fVxuXHR9O1xuXG5cdC8vIEV4ZWN1dGUgdGhlIG1vZHVsZSBmdW5jdGlvblxuXHRfX3dlYnBhY2tfbW9kdWxlc19fW21vZHVsZUlkXS5jYWxsKG1vZHVsZS5leHBvcnRzLCBtb2R1bGUsIG1vZHVsZS5leHBvcnRzLCBfX3dlYnBhY2tfcmVxdWlyZV9fKTtcblxuXHQvLyBSZXR1cm4gdGhlIGV4cG9ydHMgb2YgdGhlIG1vZHVsZVxuXHRyZXR1cm4gbW9kdWxlLmV4cG9ydHM7XG59XG5cbi8vIGV4cG9zZSB0aGUgbW9kdWxlcyBvYmplY3QgKF9fd2VicGFja19tb2R1bGVzX18pXG5fX3dlYnBhY2tfcmVxdWlyZV9fLm0gPSBfX3dlYnBhY2tfbW9kdWxlc19fO1xuXG4iLCJ2YXIgZGVmZXJyZWQgPSBbXTtcbl9fd2VicGFja19yZXF1aXJlX18uTyA9IChyZXN1bHQsIGNodW5rSWRzLCBmbiwgcHJpb3JpdHkpID0+IHtcblx0aWYoY2h1bmtJZHMpIHtcblx0XHRwcmlvcml0eSA9IHByaW9yaXR5IHx8IDA7XG5cdFx0Zm9yKHZhciBpID0gZGVmZXJyZWQubGVuZ3RoOyBpID4gMCAmJiBkZWZlcnJlZFtpIC0gMV1bMl0gPiBwcmlvcml0eTsgaS0tKSBkZWZlcnJlZFtpXSA9IGRlZmVycmVkW2kgLSAxXTtcblx0XHRkZWZlcnJlZFtpXSA9IFtjaHVua0lkcywgZm4sIHByaW9yaXR5XTtcblx0XHRyZXR1cm47XG5cdH1cblx0dmFyIG5vdEZ1bGZpbGxlZCA9IEluZmluaXR5O1xuXHRmb3IgKHZhciBpID0gMDsgaSA8IGRlZmVycmVkLmxlbmd0aDsgaSsrKSB7XG5cdFx0dmFyIFtjaHVua0lkcywgZm4sIHByaW9yaXR5XSA9IGRlZmVycmVkW2ldO1xuXHRcdHZhciBmdWxmaWxsZWQgPSB0cnVlO1xuXHRcdGZvciAodmFyIGogPSAwOyBqIDwgY2h1bmtJZHMubGVuZ3RoOyBqKyspIHtcblx0XHRcdGlmICgocHJpb3JpdHkgJiAxID09PSAwIHx8IG5vdEZ1bGZpbGxlZCA+PSBwcmlvcml0eSkgJiYgT2JqZWN0LmtleXMoX193ZWJwYWNrX3JlcXVpcmVfXy5PKS5ldmVyeSgoa2V5KSA9PiAoX193ZWJwYWNrX3JlcXVpcmVfXy5PW2tleV0oY2h1bmtJZHNbal0pKSkpIHtcblx0XHRcdFx0Y2h1bmtJZHMuc3BsaWNlKGotLSwgMSk7XG5cdFx0XHR9IGVsc2Uge1xuXHRcdFx0XHRmdWxmaWxsZWQgPSBmYWxzZTtcblx0XHRcdFx0aWYocHJpb3JpdHkgPCBub3RGdWxmaWxsZWQpIG5vdEZ1bGZpbGxlZCA9IHByaW9yaXR5O1xuXHRcdFx0fVxuXHRcdH1cblx0XHRpZihmdWxmaWxsZWQpIHtcblx0XHRcdGRlZmVycmVkLnNwbGljZShpLS0sIDEpXG5cdFx0XHR2YXIgciA9IGZuKCk7XG5cdFx0XHRpZiAociAhPT0gdW5kZWZpbmVkKSByZXN1bHQgPSByO1xuXHRcdH1cblx0fVxuXHRyZXR1cm4gcmVzdWx0O1xufTsiLCIvLyBnZXREZWZhdWx0RXhwb3J0IGZ1bmN0aW9uIGZvciBjb21wYXRpYmlsaXR5IHdpdGggbm9uLWhhcm1vbnkgbW9kdWxlc1xuX193ZWJwYWNrX3JlcXVpcmVfXy5uID0gKG1vZHVsZSkgPT4ge1xuXHR2YXIgZ2V0dGVyID0gbW9kdWxlICYmIG1vZHVsZS5fX2VzTW9kdWxlID9cblx0XHQoKSA9PiAobW9kdWxlWydkZWZhdWx0J10pIDpcblx0XHQoKSA9PiAobW9kdWxlKTtcblx0X193ZWJwYWNrX3JlcXVpcmVfXy5kKGdldHRlciwgeyBhOiBnZXR0ZXIgfSk7XG5cdHJldHVybiBnZXR0ZXI7XG59OyIsIi8vIGRlZmluZSBnZXR0ZXIgZnVuY3Rpb25zIGZvciBoYXJtb255IGV4cG9ydHNcbl9fd2VicGFja19yZXF1aXJlX18uZCA9IChleHBvcnRzLCBkZWZpbml0aW9uKSA9PiB7XG5cdGZvcih2YXIga2V5IGluIGRlZmluaXRpb24pIHtcblx0XHRpZihfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZGVmaW5pdGlvbiwga2V5KSAmJiAhX193ZWJwYWNrX3JlcXVpcmVfXy5vKGV4cG9ydHMsIGtleSkpIHtcblx0XHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBrZXksIHsgZW51bWVyYWJsZTogdHJ1ZSwgZ2V0OiBkZWZpbml0aW9uW2tleV0gfSk7XG5cdFx0fVxuXHR9XG59OyIsIl9fd2VicGFja19yZXF1aXJlX18uZiA9IHt9O1xuLy8gVGhpcyBmaWxlIGNvbnRhaW5zIG9ubHkgdGhlIGVudHJ5IGNodW5rLlxuLy8gVGhlIGNodW5rIGxvYWRpbmcgZnVuY3Rpb24gZm9yIGFkZGl0aW9uYWwgY2h1bmtzXG5fX3dlYnBhY2tfcmVxdWlyZV9fLmUgPSAoY2h1bmtJZCkgPT4ge1xuXHRyZXR1cm4gUHJvbWlzZS5hbGwoT2JqZWN0LmtleXMoX193ZWJwYWNrX3JlcXVpcmVfXy5mKS5yZWR1Y2UoKHByb21pc2VzLCBrZXkpID0+IHtcblx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLmZba2V5XShjaHVua0lkLCBwcm9taXNlcyk7XG5cdFx0cmV0dXJuIHByb21pc2VzO1xuXHR9LCBbXSkpO1xufTsiLCIvLyBUaGlzIGZ1bmN0aW9uIGFsbG93IHRvIHJlZmVyZW5jZSBhc3luYyBjaHVua3Ncbl9fd2VicGFja19yZXF1aXJlX18udSA9IChjaHVua0lkKSA9PiB7XG5cdC8vIHJldHVybiB1cmwgZm9yIGZpbGVuYW1lcyBiYXNlZCBvbiB0ZW1wbGF0ZVxuXHRyZXR1cm4gXCJcIiArIGNodW5rSWQgKyBcIi5qc1wiO1xufTsiLCIvLyBUaGlzIGZ1bmN0aW9uIGFsbG93IHRvIHJlZmVyZW5jZSBhbGwgY2h1bmtzXG5fX3dlYnBhY2tfcmVxdWlyZV9fLm1pbmlDc3NGID0gKGNodW5rSWQpID0+IHtcblx0Ly8gcmV0dXJuIHVybCBmb3IgZmlsZW5hbWVzIGJhc2VkIG9uIHRlbXBsYXRlXG5cdHJldHVybiBcIlwiICsgY2h1bmtJZCArIFwiLmNzc1wiO1xufTsiLCJfX3dlYnBhY2tfcmVxdWlyZV9fLmcgPSAoZnVuY3Rpb24oKSB7XG5cdGlmICh0eXBlb2YgZ2xvYmFsVGhpcyA9PT0gJ29iamVjdCcpIHJldHVybiBnbG9iYWxUaGlzO1xuXHR0cnkge1xuXHRcdHJldHVybiB0aGlzIHx8IG5ldyBGdW5jdGlvbigncmV0dXJuIHRoaXMnKSgpO1xuXHR9IGNhdGNoIChlKSB7XG5cdFx0aWYgKHR5cGVvZiB3aW5kb3cgPT09ICdvYmplY3QnKSByZXR1cm4gd2luZG93O1xuXHR9XG59KSgpOyIsIl9fd2VicGFja19yZXF1aXJlX18ubyA9IChvYmosIHByb3ApID0+IChPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwob2JqLCBwcm9wKSkiLCJ2YXIgaW5Qcm9ncmVzcyA9IHt9O1xudmFyIGRhdGFXZWJwYWNrUHJlZml4ID0gXCJpc3BvbnNvcjpcIjtcbi8vIGxvYWRTY3JpcHQgZnVuY3Rpb24gdG8gbG9hZCBhIHNjcmlwdCB2aWEgc2NyaXB0IHRhZ1xuX193ZWJwYWNrX3JlcXVpcmVfXy5sID0gKHVybCwgZG9uZSwga2V5LCBjaHVua0lkKSA9PiB7XG5cdGlmKGluUHJvZ3Jlc3NbdXJsXSkgeyBpblByb2dyZXNzW3VybF0ucHVzaChkb25lKTsgcmV0dXJuOyB9XG5cdHZhciBzY3JpcHQsIG5lZWRBdHRhY2g7XG5cdGlmKGtleSAhPT0gdW5kZWZpbmVkKSB7XG5cdFx0dmFyIHNjcmlwdHMgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5VGFnTmFtZShcInNjcmlwdFwiKTtcblx0XHRmb3IodmFyIGkgPSAwOyBpIDwgc2NyaXB0cy5sZW5ndGg7IGkrKykge1xuXHRcdFx0dmFyIHMgPSBzY3JpcHRzW2ldO1xuXHRcdFx0aWYocy5nZXRBdHRyaWJ1dGUoXCJzcmNcIikgPT0gdXJsIHx8IHMuZ2V0QXR0cmlidXRlKFwiZGF0YS13ZWJwYWNrXCIpID09IGRhdGFXZWJwYWNrUHJlZml4ICsga2V5KSB7IHNjcmlwdCA9IHM7IGJyZWFrOyB9XG5cdFx0fVxuXHR9XG5cdGlmKCFzY3JpcHQpIHtcblx0XHRuZWVkQXR0YWNoID0gdHJ1ZTtcblx0XHRzY3JpcHQgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdzY3JpcHQnKTtcblxuXHRcdHNjcmlwdC5jaGFyc2V0ID0gJ3V0Zi04Jztcblx0XHRzY3JpcHQudGltZW91dCA9IDEyMDtcblx0XHRpZiAoX193ZWJwYWNrX3JlcXVpcmVfXy5uYykge1xuXHRcdFx0c2NyaXB0LnNldEF0dHJpYnV0ZShcIm5vbmNlXCIsIF9fd2VicGFja19yZXF1aXJlX18ubmMpO1xuXHRcdH1cblx0XHRzY3JpcHQuc2V0QXR0cmlidXRlKFwiZGF0YS13ZWJwYWNrXCIsIGRhdGFXZWJwYWNrUHJlZml4ICsga2V5KTtcblx0XHRzY3JpcHQuc3JjID0gdXJsO1xuXHR9XG5cdGluUHJvZ3Jlc3NbdXJsXSA9IFtkb25lXTtcblx0dmFyIG9uU2NyaXB0Q29tcGxldGUgPSAocHJldiwgZXZlbnQpID0+IHtcblx0XHQvLyBhdm9pZCBtZW0gbGVha3MgaW4gSUUuXG5cdFx0c2NyaXB0Lm9uZXJyb3IgPSBzY3JpcHQub25sb2FkID0gbnVsbDtcblx0XHRjbGVhclRpbWVvdXQodGltZW91dCk7XG5cdFx0dmFyIGRvbmVGbnMgPSBpblByb2dyZXNzW3VybF07XG5cdFx0ZGVsZXRlIGluUHJvZ3Jlc3NbdXJsXTtcblx0XHRzY3JpcHQucGFyZW50Tm9kZSAmJiBzY3JpcHQucGFyZW50Tm9kZS5yZW1vdmVDaGlsZChzY3JpcHQpO1xuXHRcdGRvbmVGbnMgJiYgZG9uZUZucy5mb3JFYWNoKChmbikgPT4gKGZuKGV2ZW50KSkpO1xuXHRcdGlmKHByZXYpIHJldHVybiBwcmV2KGV2ZW50KTtcblx0fVxuXHR2YXIgdGltZW91dCA9IHNldFRpbWVvdXQob25TY3JpcHRDb21wbGV0ZS5iaW5kKG51bGwsIHVuZGVmaW5lZCwgeyB0eXBlOiAndGltZW91dCcsIHRhcmdldDogc2NyaXB0IH0pLCAxMjAwMDApO1xuXHRzY3JpcHQub25lcnJvciA9IG9uU2NyaXB0Q29tcGxldGUuYmluZChudWxsLCBzY3JpcHQub25lcnJvcik7XG5cdHNjcmlwdC5vbmxvYWQgPSBvblNjcmlwdENvbXBsZXRlLmJpbmQobnVsbCwgc2NyaXB0Lm9ubG9hZCk7XG5cdG5lZWRBdHRhY2ggJiYgZG9jdW1lbnQuaGVhZC5hcHBlbmRDaGlsZChzY3JpcHQpO1xufTsiLCIvLyBkZWZpbmUgX19lc01vZHVsZSBvbiBleHBvcnRzXG5fX3dlYnBhY2tfcmVxdWlyZV9fLnIgPSAoZXhwb3J0cykgPT4ge1xuXHRpZih0eXBlb2YgU3ltYm9sICE9PSAndW5kZWZpbmVkJyAmJiBTeW1ib2wudG9TdHJpbmdUYWcpIHtcblx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgU3ltYm9sLnRvU3RyaW5nVGFnLCB7IHZhbHVlOiAnTW9kdWxlJyB9KTtcblx0fVxuXHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgJ19fZXNNb2R1bGUnLCB7IHZhbHVlOiB0cnVlIH0pO1xufTsiLCJfX3dlYnBhY2tfcmVxdWlyZV9fLnAgPSBcIi9idWlsZC9cIjsiLCJ2YXIgY3JlYXRlU3R5bGVzaGVldCA9IChjaHVua0lkLCBmdWxsaHJlZiwgcmVzb2x2ZSwgcmVqZWN0KSA9PiB7XG5cdHZhciBsaW5rVGFnID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudChcImxpbmtcIik7XG5cblx0bGlua1RhZy5yZWwgPSBcInN0eWxlc2hlZXRcIjtcblx0bGlua1RhZy50eXBlID0gXCJ0ZXh0L2Nzc1wiO1xuXHR2YXIgb25MaW5rQ29tcGxldGUgPSAoZXZlbnQpID0+IHtcblx0XHQvLyBhdm9pZCBtZW0gbGVha3MuXG5cdFx0bGlua1RhZy5vbmVycm9yID0gbGlua1RhZy5vbmxvYWQgPSBudWxsO1xuXHRcdGlmIChldmVudC50eXBlID09PSAnbG9hZCcpIHtcblx0XHRcdHJlc29sdmUoKTtcblx0XHR9IGVsc2Uge1xuXHRcdFx0dmFyIGVycm9yVHlwZSA9IGV2ZW50ICYmIChldmVudC50eXBlID09PSAnbG9hZCcgPyAnbWlzc2luZycgOiBldmVudC50eXBlKTtcblx0XHRcdHZhciByZWFsSHJlZiA9IGV2ZW50ICYmIGV2ZW50LnRhcmdldCAmJiBldmVudC50YXJnZXQuaHJlZiB8fCBmdWxsaHJlZjtcblx0XHRcdHZhciBlcnIgPSBuZXcgRXJyb3IoXCJMb2FkaW5nIENTUyBjaHVuayBcIiArIGNodW5rSWQgKyBcIiBmYWlsZWQuXFxuKFwiICsgcmVhbEhyZWYgKyBcIilcIik7XG5cdFx0XHRlcnIuY29kZSA9IFwiQ1NTX0NIVU5LX0xPQURfRkFJTEVEXCI7XG5cdFx0XHRlcnIudHlwZSA9IGVycm9yVHlwZTtcblx0XHRcdGVyci5yZXF1ZXN0ID0gcmVhbEhyZWY7XG5cdFx0XHRsaW5rVGFnLnBhcmVudE5vZGUucmVtb3ZlQ2hpbGQobGlua1RhZylcblx0XHRcdHJlamVjdChlcnIpO1xuXHRcdH1cblx0fVxuXHRsaW5rVGFnLm9uZXJyb3IgPSBsaW5rVGFnLm9ubG9hZCA9IG9uTGlua0NvbXBsZXRlO1xuXHRsaW5rVGFnLmhyZWYgPSBmdWxsaHJlZjtcblxuXHRkb2N1bWVudC5oZWFkLmFwcGVuZENoaWxkKGxpbmtUYWcpO1xuXHRyZXR1cm4gbGlua1RhZztcbn07XG52YXIgZmluZFN0eWxlc2hlZXQgPSAoaHJlZiwgZnVsbGhyZWYpID0+IHtcblx0dmFyIGV4aXN0aW5nTGlua1RhZ3MgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5VGFnTmFtZShcImxpbmtcIik7XG5cdGZvcih2YXIgaSA9IDA7IGkgPCBleGlzdGluZ0xpbmtUYWdzLmxlbmd0aDsgaSsrKSB7XG5cdFx0dmFyIHRhZyA9IGV4aXN0aW5nTGlua1RhZ3NbaV07XG5cdFx0dmFyIGRhdGFIcmVmID0gdGFnLmdldEF0dHJpYnV0ZShcImRhdGEtaHJlZlwiKSB8fCB0YWcuZ2V0QXR0cmlidXRlKFwiaHJlZlwiKTtcblx0XHRpZih0YWcucmVsID09PSBcInN0eWxlc2hlZXRcIiAmJiAoZGF0YUhyZWYgPT09IGhyZWYgfHwgZGF0YUhyZWYgPT09IGZ1bGxocmVmKSkgcmV0dXJuIHRhZztcblx0fVxuXHR2YXIgZXhpc3RpbmdTdHlsZVRhZ3MgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5VGFnTmFtZShcInN0eWxlXCIpO1xuXHRmb3IodmFyIGkgPSAwOyBpIDwgZXhpc3RpbmdTdHlsZVRhZ3MubGVuZ3RoOyBpKyspIHtcblx0XHR2YXIgdGFnID0gZXhpc3RpbmdTdHlsZVRhZ3NbaV07XG5cdFx0dmFyIGRhdGFIcmVmID0gdGFnLmdldEF0dHJpYnV0ZShcImRhdGEtaHJlZlwiKTtcblx0XHRpZihkYXRhSHJlZiA9PT0gaHJlZiB8fCBkYXRhSHJlZiA9PT0gZnVsbGhyZWYpIHJldHVybiB0YWc7XG5cdH1cbn07XG52YXIgbG9hZFN0eWxlc2hlZXQgPSAoY2h1bmtJZCkgPT4ge1xuXHRyZXR1cm4gbmV3IFByb21pc2UoKHJlc29sdmUsIHJlamVjdCkgPT4ge1xuXHRcdHZhciBocmVmID0gX193ZWJwYWNrX3JlcXVpcmVfXy5taW5pQ3NzRihjaHVua0lkKTtcblx0XHR2YXIgZnVsbGhyZWYgPSBfX3dlYnBhY2tfcmVxdWlyZV9fLnAgKyBocmVmO1xuXHRcdGlmKGZpbmRTdHlsZXNoZWV0KGhyZWYsIGZ1bGxocmVmKSkgcmV0dXJuIHJlc29sdmUoKTtcblx0XHRjcmVhdGVTdHlsZXNoZWV0KGNodW5rSWQsIGZ1bGxocmVmLCByZXNvbHZlLCByZWplY3QpO1xuXHR9KTtcbn1cbi8vIG9iamVjdCB0byBzdG9yZSBsb2FkZWQgQ1NTIGNodW5rc1xudmFyIGluc3RhbGxlZENzc0NodW5rcyA9IHtcblx0XCJwcm9maWxlXCI6IDBcbn07XG5cbl9fd2VicGFja19yZXF1aXJlX18uZi5taW5pQ3NzID0gKGNodW5rSWQsIHByb21pc2VzKSA9PiB7XG5cdHZhciBjc3NDaHVua3MgPSB7XCJhc3NldF9jc3NfbmF2YmFyX2Nzc1wiOjF9O1xuXHRpZihpbnN0YWxsZWRDc3NDaHVua3NbY2h1bmtJZF0pIHByb21pc2VzLnB1c2goaW5zdGFsbGVkQ3NzQ2h1bmtzW2NodW5rSWRdKTtcblx0ZWxzZSBpZihpbnN0YWxsZWRDc3NDaHVua3NbY2h1bmtJZF0gIT09IDAgJiYgY3NzQ2h1bmtzW2NodW5rSWRdKSB7XG5cdFx0cHJvbWlzZXMucHVzaChpbnN0YWxsZWRDc3NDaHVua3NbY2h1bmtJZF0gPSBsb2FkU3R5bGVzaGVldChjaHVua0lkKS50aGVuKCgpID0+IHtcblx0XHRcdGluc3RhbGxlZENzc0NodW5rc1tjaHVua0lkXSA9IDA7XG5cdFx0fSwgKGUpID0+IHtcblx0XHRcdGRlbGV0ZSBpbnN0YWxsZWRDc3NDaHVua3NbY2h1bmtJZF07XG5cdFx0XHR0aHJvdyBlO1xuXHRcdH0pKTtcblx0fVxufTtcblxuLy8gbm8gaG1yIiwiLy8gbm8gYmFzZVVSSVxuXG4vLyBvYmplY3QgdG8gc3RvcmUgbG9hZGVkIGFuZCBsb2FkaW5nIGNodW5rc1xuLy8gdW5kZWZpbmVkID0gY2h1bmsgbm90IGxvYWRlZCwgbnVsbCA9IGNodW5rIHByZWxvYWRlZC9wcmVmZXRjaGVkXG4vLyBbcmVzb2x2ZSwgcmVqZWN0LCBQcm9taXNlXSA9IGNodW5rIGxvYWRpbmcsIDAgPSBjaHVuayBsb2FkZWRcbnZhciBpbnN0YWxsZWRDaHVua3MgPSB7XG5cdFwicHJvZmlsZVwiOiAwLFxuXHRcInZlbmRvcnMtbm9kZV9tb2R1bGVzX3RpbnltY2Vfc2tpbnNfdWlfb3hpZGVfY29udGVudF9taW5fY3NzLW5vZGVfbW9kdWxlc190aW55bWNlX3NraW5zX3VpX294aS0yOWM3MGZcIjogMFxufTtcblxuX193ZWJwYWNrX3JlcXVpcmVfXy5mLmogPSAoY2h1bmtJZCwgcHJvbWlzZXMpID0+IHtcblx0XHQvLyBKU09OUCBjaHVuayBsb2FkaW5nIGZvciBqYXZhc2NyaXB0XG5cdFx0dmFyIGluc3RhbGxlZENodW5rRGF0YSA9IF9fd2VicGFja19yZXF1aXJlX18ubyhpbnN0YWxsZWRDaHVua3MsIGNodW5rSWQpID8gaW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdIDogdW5kZWZpbmVkO1xuXHRcdGlmKGluc3RhbGxlZENodW5rRGF0YSAhPT0gMCkgeyAvLyAwIG1lYW5zIFwiYWxyZWFkeSBpbnN0YWxsZWRcIi5cblxuXHRcdFx0Ly8gYSBQcm9taXNlIG1lYW5zIFwiY3VycmVudGx5IGxvYWRpbmdcIi5cblx0XHRcdGlmKGluc3RhbGxlZENodW5rRGF0YSkge1xuXHRcdFx0XHRwcm9taXNlcy5wdXNoKGluc3RhbGxlZENodW5rRGF0YVsyXSk7XG5cdFx0XHR9IGVsc2Uge1xuXHRcdFx0XHRpZihcInZlbmRvcnMtbm9kZV9tb2R1bGVzX3RpbnltY2Vfc2tpbnNfdWlfb3hpZGVfY29udGVudF9taW5fY3NzLW5vZGVfbW9kdWxlc190aW55bWNlX3NraW5zX3VpX294aS0yOWM3MGZcIiAhPSBjaHVua0lkKSB7XG5cdFx0XHRcdFx0Ly8gc2V0dXAgUHJvbWlzZSBpbiBjaHVuayBjYWNoZVxuXHRcdFx0XHRcdHZhciBwcm9taXNlID0gbmV3IFByb21pc2UoKHJlc29sdmUsIHJlamVjdCkgPT4gKGluc3RhbGxlZENodW5rRGF0YSA9IGluc3RhbGxlZENodW5rc1tjaHVua0lkXSA9IFtyZXNvbHZlLCByZWplY3RdKSk7XG5cdFx0XHRcdFx0cHJvbWlzZXMucHVzaChpbnN0YWxsZWRDaHVua0RhdGFbMl0gPSBwcm9taXNlKTtcblxuXHRcdFx0XHRcdC8vIHN0YXJ0IGNodW5rIGxvYWRpbmdcblx0XHRcdFx0XHR2YXIgdXJsID0gX193ZWJwYWNrX3JlcXVpcmVfXy5wICsgX193ZWJwYWNrX3JlcXVpcmVfXy51KGNodW5rSWQpO1xuXHRcdFx0XHRcdC8vIGNyZWF0ZSBlcnJvciBiZWZvcmUgc3RhY2sgdW53b3VuZCB0byBnZXQgdXNlZnVsIHN0YWNrdHJhY2UgbGF0ZXJcblx0XHRcdFx0XHR2YXIgZXJyb3IgPSBuZXcgRXJyb3IoKTtcblx0XHRcdFx0XHR2YXIgbG9hZGluZ0VuZGVkID0gKGV2ZW50KSA9PiB7XG5cdFx0XHRcdFx0XHRpZihfX3dlYnBhY2tfcmVxdWlyZV9fLm8oaW5zdGFsbGVkQ2h1bmtzLCBjaHVua0lkKSkge1xuXHRcdFx0XHRcdFx0XHRpbnN0YWxsZWRDaHVua0RhdGEgPSBpbnN0YWxsZWRDaHVua3NbY2h1bmtJZF07XG5cdFx0XHRcdFx0XHRcdGlmKGluc3RhbGxlZENodW5rRGF0YSAhPT0gMCkgaW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdID0gdW5kZWZpbmVkO1xuXHRcdFx0XHRcdFx0XHRpZihpbnN0YWxsZWRDaHVua0RhdGEpIHtcblx0XHRcdFx0XHRcdFx0XHR2YXIgZXJyb3JUeXBlID0gZXZlbnQgJiYgKGV2ZW50LnR5cGUgPT09ICdsb2FkJyA/ICdtaXNzaW5nJyA6IGV2ZW50LnR5cGUpO1xuXHRcdFx0XHRcdFx0XHRcdHZhciByZWFsU3JjID0gZXZlbnQgJiYgZXZlbnQudGFyZ2V0ICYmIGV2ZW50LnRhcmdldC5zcmM7XG5cdFx0XHRcdFx0XHRcdFx0ZXJyb3IubWVzc2FnZSA9ICdMb2FkaW5nIGNodW5rICcgKyBjaHVua0lkICsgJyBmYWlsZWQuXFxuKCcgKyBlcnJvclR5cGUgKyAnOiAnICsgcmVhbFNyYyArICcpJztcblx0XHRcdFx0XHRcdFx0XHRlcnJvci5uYW1lID0gJ0NodW5rTG9hZEVycm9yJztcblx0XHRcdFx0XHRcdFx0XHRlcnJvci50eXBlID0gZXJyb3JUeXBlO1xuXHRcdFx0XHRcdFx0XHRcdGVycm9yLnJlcXVlc3QgPSByZWFsU3JjO1xuXHRcdFx0XHRcdFx0XHRcdGluc3RhbGxlZENodW5rRGF0YVsxXShlcnJvcik7XG5cdFx0XHRcdFx0XHRcdH1cblx0XHRcdFx0XHRcdH1cblx0XHRcdFx0XHR9O1xuXHRcdFx0XHRcdF9fd2VicGFja19yZXF1aXJlX18ubCh1cmwsIGxvYWRpbmdFbmRlZCwgXCJjaHVuay1cIiArIGNodW5rSWQsIGNodW5rSWQpO1xuXHRcdFx0XHR9IGVsc2UgaW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdID0gMDtcblx0XHRcdH1cblx0XHR9XG59O1xuXG4vLyBubyBwcmVmZXRjaGluZ1xuXG4vLyBubyBwcmVsb2FkZWRcblxuLy8gbm8gSE1SXG5cbi8vIG5vIEhNUiBtYW5pZmVzdFxuXG5fX3dlYnBhY2tfcmVxdWlyZV9fLk8uaiA9IChjaHVua0lkKSA9PiAoaW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdID09PSAwKTtcblxuLy8gaW5zdGFsbCBhIEpTT05QIGNhbGxiYWNrIGZvciBjaHVuayBsb2FkaW5nXG52YXIgd2VicGFja0pzb25wQ2FsbGJhY2sgPSAocGFyZW50Q2h1bmtMb2FkaW5nRnVuY3Rpb24sIGRhdGEpID0+IHtcblx0dmFyIFtjaHVua0lkcywgbW9yZU1vZHVsZXMsIHJ1bnRpbWVdID0gZGF0YTtcblx0Ly8gYWRkIFwibW9yZU1vZHVsZXNcIiB0byB0aGUgbW9kdWxlcyBvYmplY3QsXG5cdC8vIHRoZW4gZmxhZyBhbGwgXCJjaHVua0lkc1wiIGFzIGxvYWRlZCBhbmQgZmlyZSBjYWxsYmFja1xuXHR2YXIgbW9kdWxlSWQsIGNodW5rSWQsIGkgPSAwO1xuXHRpZihjaHVua0lkcy5zb21lKChpZCkgPT4gKGluc3RhbGxlZENodW5rc1tpZF0gIT09IDApKSkge1xuXHRcdGZvcihtb2R1bGVJZCBpbiBtb3JlTW9kdWxlcykge1xuXHRcdFx0aWYoX193ZWJwYWNrX3JlcXVpcmVfXy5vKG1vcmVNb2R1bGVzLCBtb2R1bGVJZCkpIHtcblx0XHRcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5tW21vZHVsZUlkXSA9IG1vcmVNb2R1bGVzW21vZHVsZUlkXTtcblx0XHRcdH1cblx0XHR9XG5cdFx0aWYocnVudGltZSkgdmFyIHJlc3VsdCA9IHJ1bnRpbWUoX193ZWJwYWNrX3JlcXVpcmVfXyk7XG5cdH1cblx0aWYocGFyZW50Q2h1bmtMb2FkaW5nRnVuY3Rpb24pIHBhcmVudENodW5rTG9hZGluZ0Z1bmN0aW9uKGRhdGEpO1xuXHRmb3IoO2kgPCBjaHVua0lkcy5sZW5ndGg7IGkrKykge1xuXHRcdGNodW5rSWQgPSBjaHVua0lkc1tpXTtcblx0XHRpZihfX3dlYnBhY2tfcmVxdWlyZV9fLm8oaW5zdGFsbGVkQ2h1bmtzLCBjaHVua0lkKSAmJiBpbnN0YWxsZWRDaHVua3NbY2h1bmtJZF0pIHtcblx0XHRcdGluc3RhbGxlZENodW5rc1tjaHVua0lkXVswXSgpO1xuXHRcdH1cblx0XHRpbnN0YWxsZWRDaHVua3NbY2h1bmtJZF0gPSAwO1xuXHR9XG5cdHJldHVybiBfX3dlYnBhY2tfcmVxdWlyZV9fLk8ocmVzdWx0KTtcbn1cblxudmFyIGNodW5rTG9hZGluZ0dsb2JhbCA9IHNlbGZbXCJ3ZWJwYWNrQ2h1bmtpc3BvbnNvclwiXSA9IHNlbGZbXCJ3ZWJwYWNrQ2h1bmtpc3BvbnNvclwiXSB8fCBbXTtcbmNodW5rTG9hZGluZ0dsb2JhbC5mb3JFYWNoKHdlYnBhY2tKc29ucENhbGxiYWNrLmJpbmQobnVsbCwgMCkpO1xuY2h1bmtMb2FkaW5nR2xvYmFsLnB1c2ggPSB3ZWJwYWNrSnNvbnBDYWxsYmFjay5iaW5kKG51bGwsIGNodW5rTG9hZGluZ0dsb2JhbC5wdXNoLmJpbmQoY2h1bmtMb2FkaW5nR2xvYmFsKSk7IiwiIiwiLy8gc3RhcnR1cFxuLy8gTG9hZCBlbnRyeSBtb2R1bGUgYW5kIHJldHVybiBleHBvcnRzXG4vLyBUaGlzIGVudHJ5IG1vZHVsZSBkZXBlbmRzIG9uIG90aGVyIGxvYWRlZCBjaHVua3MgYW5kIGV4ZWN1dGlvbiBuZWVkIHRvIGJlIGRlbGF5ZWRcbnZhciBfX3dlYnBhY2tfZXhwb3J0c19fID0gX193ZWJwYWNrX3JlcXVpcmVfXy5PKHVuZGVmaW5lZCwgW1widmVuZG9ycy1ub2RlX21vZHVsZXNfcG9wcGVyanNfY29yZV9saWJfaW5kZXhfanMtbm9kZV9tb2R1bGVzX2NvcmUtanNfaW50ZXJuYWxzX2EtY29uc3RydWN0b3JfLWU4NmY5ZFwiLFwidmVuZG9ycy1ub2RlX21vZHVsZXNfYm9vdHN0cmFwX2Rpc3RfanNfYm9vdHN0cmFwX2VzbV9qc1wiLFwidmVuZG9ycy1ub2RlX21vZHVsZXNfY29yZS1qc19tb2R1bGVzX2VzX2FycmF5X2NvbmNhdF9qcy1ub2RlX21vZHVsZXNfY29yZS1qc19tb2R1bGVzX2VzX2FycmF5LTIwNDE2MlwiLFwidmVuZG9ycy1ub2RlX21vZHVsZXNfYm9vdHN0cmFwX2Rpc3RfanNfYm9vdHN0cmFwX2VzbV9taW5fanNcIixcInZlbmRvcnMtbm9kZV9tb2R1bGVzX21hc29ucnktbGF5b3V0X21hc29ucnlfanMtbm9kZV9tb2R1bGVzX2pzLWNvb2tpZV9kaXN0X2pzX2Nvb2tpZV9tanNcIixcInZlbmRvcnMtbm9kZV9tb2R1bGVzX3RpbnltY2Vfc2tpbnNfdWlfb3hpZGVfY29udGVudF9taW5fY3NzLW5vZGVfbW9kdWxlc190aW55bWNlX3NraW5zX3VpX294aS0yOWM3MGZcIixcInZlbmRvcnMtbm9kZV9tb2R1bGVzX3RpbnltY2Vfc2tpbnNfdWlfb3hpZGVfc2tpbl9jc3Mtbm9kZV9tb2R1bGVzX3RpbnltY2VfcGx1Z2luc19pbWFnZV9pbmRleC0xMTU2OTFcIixcImFzc2V0X2ZvbnRhd2Vzb21lLXByb19qc19hbGxfbWluX2pzXCJdLCAoKSA9PiAoX193ZWJwYWNrX3JlcXVpcmVfXyhcIi4vYXNzZXQvanMvcHJvZmlsZS5qc1wiKSkpXG5fX3dlYnBhY2tfZXhwb3J0c19fID0gX193ZWJwYWNrX3JlcXVpcmVfXy5PKF9fd2VicGFja19leHBvcnRzX18pO1xuIiwiIl0sIm5hbWVzIjpbIkNvb2tpZXMiLCJNYXNvbnJ5IiwiZnVsbFNjcmVlbkJ1dHRvbiIsImRvY3VtZW50IiwicXVlcnlTZWxlY3RvciIsIm1hc29ucnlHcmlkIiwiZnVsbFNjcmVlbkljb24iLCIkZnVsbFNjcmVlbkljb24iLCJ0b2dnbGVDbGFzcyIsIiRmdWxsU2NySWNvbkNsYXNzIiwiJGZ1bGxTY3JJY29uUHJlc3MiLCJhc2lkZVJpZ2h0UGFuZWwiLCIkYXNpZGVSaWdodFBhbmVsIiwiY3NzIiwidW5iaW5kIiwibWFzb25yeUxheW91dCIsIiRtYXNvbnJ5R3JpZCIsImxlbmd0aCIsIiRtYXNvbnJ5IiwibGF5b3V0IiwiJGh0bWwiLCIkIiwiJGhpZGVBcnJheSIsIiRwYW5lbCIsImZpbHRlciIsIiRjb250ZW50QmxvY2siLCIkZnVsbFNjcmVlbkJ1dHRvbiIsIiRmdWxsU2NyZWVuTWVzc2FnZSIsIiR3aWR0aCIsIndpZHRoIiwicGFyZW50IiwiJG1hc29ucnlCcmljayIsIml0ZW1TZWxlY3RvciIsImdldCIsImNsaWNrIiwiTWF0aCIsInJvdW5kIiwic2hvdyIsInJlbW92ZUNsYXNzIiwiYWRkQ2xhc3MiLCJoaWRlIiwidG9nZ2xlIiwiYW5pbWF0ZSIsInJpZ2h0Iiwib24iLCJ0cmlnZ2VyIiwia2V5cHJlc3MiLCJlIiwia2V5Q29kZSIsIm1vZGFsIiwid2luZG93Iiwib25sb2FkIiwiYWRkRXZlbnRMaXN0ZW5lciIsImV2ZW50IiwibW92ZVVwIiwiZGl2IiwicXVlcnlTZWxlY3RvckFsbCIsIm1vdmVVcEJsb2NrIiwic2Nyb2xsIiwic2Nyb2xsWSIsImZhZGVJbiIsImZhZGVPdXQiLCJodG1sIiwic2Nyb2xsVG9wIiwiVG9hc3QiLCJyZXF1aXJlIiwiQXJyYXkiLCJmcm9tIiwiZm9yRWFjaCIsInRvYXN0Tm9kZSIsInRpbnltY2UiLCJmb3JtIiwidW5kZWZpbmVkIiwiaW5pdCIsInNlbGVjdG9yIiwicGx1Z2lucyIsInRvb2xiYXIiLCJhdXRvbWF0aWNfdXBsb2FkcyIsImltYWdlc191cGxvYWRfdXJsIiwiZGF0YXNldCIsIm5hbWUiLCJvYmplY3RJZCIsImZpbGVfcGlja2VyX3R5cGVzIiwiZmlsZV9waWNrZXJfY2FsbGJhY2siLCJjYiIsInZhbHVlIiwibWV0YSIsImlucHV0IiwiY3JlYXRlRWxlbWVudCIsInNldEF0dHJpYnV0ZSIsIm9uY2hhbmdlIiwiZmlsZSIsImZpbGVzIiwicmVhZGVyIiwiRmlsZVJlYWRlciIsImlkIiwiRGF0ZSIsImdldFRpbWUiLCJibG9iQ2FjaGUiLCJhY3RpdmVFZGl0b3IiLCJlZGl0b3JVcGxvYWQiLCJiYXNlNjQiLCJyZXN1bHQiLCJzcGxpdCIsImJsb2JJbmZvIiwiY3JlYXRlIiwiYWRkIiwiYmxvYlVyaSIsInRpdGxlIiwicmVhZEFzRGF0YVVSTCJdLCJzb3VyY2VSb290IjoiIn0=