/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./asset/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j%7Ct)sx?$":
/*!******************************************************************************************************************!*\
  !*** ./asset/controllers/ sync ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \.(j%7Ct)sx?$ ***!
  \******************************************************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var map = {
	"./cropper_controller.js": "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./asset/controllers/cropper_controller.js"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./asset/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j%7Ct)sx?$";

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./asset/controllers.json":
/*!***********************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./asset/controllers.json ***!
  \***********************************************************************************************/
/***/ (() => {

throw new Error("Module build failed (from ./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js):\nError: The file \"@symfony/ux-chartjs/package.json\" could not be found. Try running \"yarn install --force\".\n    at createControllersModule (D:\\PhpstormProjects\\...iSponsorSymfony6\\node_modules\\@symfony\\stimulus-bridge\\dist\\webpack\\loader.js:46:19)\n    at Object.loader (D:\\PhpstormProjects\\...iSponsorSymfony6\\node_modules\\@symfony\\stimulus-bridge\\dist\\webpack\\loader.js:106:43)");

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./asset/controllers/cropper_controller.js":
/*!*******************************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./asset/controllers/cropper_controller.js ***!
  \*******************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _default)
/* harmony export */ });
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of.js */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.function.bind.js */ "./node_modules/core-js/modules/es.function.bind.js");
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of.js */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.reflect.construct.js */ "./node_modules/core-js/modules/es.reflect.construct.js");
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.object.create.js */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_symbol_to_primitive_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.symbol.to-primitive.js */ "./node_modules/core-js/modules/es.symbol.to-primitive.js");
/* harmony import */ var core_js_modules_es_symbol_to_primitive_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_to_primitive_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_date_to_primitive_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.date.to-primitive.js */ "./node_modules/core-js/modules/es.date.to-primitive.js");
/* harmony import */ var core_js_modules_es_date_to_primitive_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_date_to_primitive_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_es_number_constructor_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/es.number.constructor.js */ "./node_modules/core-js/modules/es.number.constructor.js");
/* harmony import */ var core_js_modules_es_number_constructor_js__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_number_constructor_js__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_14__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_15___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_15__);
/* harmony import */ var stimulus__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! stimulus */ "./node_modules/stimulus/index.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
















function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }
function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }
function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }
function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }
function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }
function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }
function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var _default = /*#__PURE__*/function (_Controller) {
  _inherits(_default, _Controller);
  var _super = _createSuper(_default);
  function _default() {
    _classCallCheck(this, _default);
    return _super.apply(this, arguments);
  }
  _createClass(_default, [{
    key: "connect",
    value: function connect() {
      this.element.addEventListener('cropperjs:connect', this._onConnect);
    }
  }, {
    key: "disconnect",
    value: function disconnect() {
      // You should always remove listeners when the controller is disconnected to avoid side effects
      this.element.removeEventListener('cropperjs:connect', this._onConnect);
    }
  }, {
    key: "_onConnect",
    value: function _onConnect(event) {
      console.log(event.detail.cropper);
      console.log(event.detail.options);
      console.log(event.detail.img);
      event.detail.img.addEventListener('cropend', function () {
        console.log("ended crojopamndkjwnbd");
      });
    }
  }]);
  return _default;
}(stimulus__WEBPACK_IMPORTED_MODULE_16__.Controller);


/***/ }),

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

/***/ "./asset/js/homepage.js":
/*!******************************!*\
  !*** ./asset/js/homepage.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.array.from.js */ "./node_modules/core-js/modules/es.array.from.js");
/* harmony import */ var core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _stimulus_bridge_init__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../stimulus_bridge_init */ "./asset/stimulus_bridge_init.js");
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
/* harmony import */ var bootstrap_dist_js_bootstrap_esm_min__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! bootstrap/dist/js/bootstrap.esm.min */ "./node_modules/bootstrap/dist/js/bootstrap.esm.min.js");







//import 'bootstrap/dist/js/bootstrap.bundle.min'


//require('bootstrap-autohide-navbar');

// require('smartwizard');

//require('masonry-layout');
__webpack_require__(/*! ../scss/homepage.scss */ "./asset/scss/homepage.scss");
__webpack_require__(/*! ../css/homepage.css */ "./asset/css/homepage.css");

//import('./masonry_init.js');
//import('../css/app.css');
// import('../css/navbar.css');

// //require('../css/likeMasonryCart.css');
__webpack_require__(/*! ../fontawesome-pro/js/all.min */ "./asset/fontawesome-pro/js/all.min.js");
// require('./auto_hiding_navbar_init');
// require('./bootstrap-tags-input-init');
// require('./cart.js');
// //require('./multistep_form');
// require('./tinymce_init');
// require('./smartwizard_init');
__webpack_require__(/*! ./move_up */ "./asset/js/move_up.js");
// //require('./masonry_init');
// require('./cols_per_row');
// require('./add-collection-widget');
__webpack_require__(/*! ./full_screen */ "./asset/js/full_screen.js");
Array.from(document.querySelectorAll('.toast')).forEach(function (toastNode) {
  return new bootstrap_dist_js_bootstrap_esm_min__WEBPACK_IMPORTED_MODULE_7__.Toast(toastNode).show();
});

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

/***/ "./asset/stimulus_bridge_init.js":
/*!***************************************!*\
  !*** ./asset/stimulus_bridge_init.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   app: () => (/* binding */ app)
/* harmony export */ });
/* harmony import */ var _symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @symfony/stimulus-bridge */ "./node_modules/@symfony/stimulus-bridge/dist/index.js");


// Registers Stimulus controllers from controllers.json and in the controllers/ directory
var app = (0,_symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__.startStimulusApp)(__webpack_require__("./asset/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.(j%7Ct)sx?$"));

/***/ }),

/***/ "./asset/css/homepage.css":
/*!********************************!*\
  !*** ./asset/css/homepage.css ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./asset/scss/homepage.scss":
/*!**********************************!*\
  !*** ./asset/scss/homepage.scss ***!
  \**********************************/
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
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"homepage": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
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
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["vendors-node_modules_popperjs_core_lib_index_js-node_modules_core-js_internals_a-constructor_-e86f9d","vendors-node_modules_bootstrap_dist_js_bootstrap_esm_js","vendors-node_modules_core-js_modules_es_array_concat_js-node_modules_core-js_modules_es_array-204162","vendors-node_modules_bootstrap_dist_js_bootstrap_esm_min_js","vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_core-js_modules_es_da-9209ed","vendors-node_modules_masonry-layout_masonry_js-node_modules_js-cookie_dist_js_cookie_mjs","asset_fontawesome-pro_js_all_min_js"], () => (__webpack_require__("./asset/js/homepage.js")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiaG9tZXBhZ2UuanMiLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7O0FBQUE7QUFDQTtBQUNBOzs7QUFHQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQ3RCc0M7QUFBQSxJQUFBQyxRQUFBLDBCQUFBQyxXQUFBO0VBQUFDLFNBQUEsQ0FBQUYsUUFBQSxFQUFBQyxXQUFBO0VBQUEsSUFBQUUsTUFBQSxHQUFBQyxZQUFBLENBQUFKLFFBQUE7RUFBQSxTQUFBQSxTQUFBO0lBQUFLLGVBQUEsT0FBQUwsUUFBQTtJQUFBLE9BQUFHLE1BQUEsQ0FBQUcsS0FBQSxPQUFBQyxTQUFBO0VBQUE7RUFBQUMsWUFBQSxDQUFBUixRQUFBO0lBQUFTLEdBQUE7SUFBQUMsS0FBQSxFQUdsQyxTQUFBQyxRQUFBLEVBQVU7TUFDTixJQUFJLENBQUNDLE9BQU8sQ0FBQ0MsZ0JBQWdCLENBQUMsbUJBQW1CLEVBQUUsSUFBSSxDQUFDQyxVQUFVLENBQUM7SUFDdkU7RUFBQztJQUFBTCxHQUFBO0lBQUFDLEtBQUEsRUFFRCxTQUFBSyxXQUFBLEVBQWE7TUFDVDtNQUNBLElBQUksQ0FBQ0gsT0FBTyxDQUFDSSxtQkFBbUIsQ0FBQyxtQkFBbUIsRUFBRSxJQUFJLENBQUNGLFVBQVUsQ0FBQztJQUMxRTtFQUFDO0lBQUFMLEdBQUE7SUFBQUMsS0FBQSxFQUVELFNBQUFJLFdBQVdHLEtBQUssRUFBRTtNQUNkQyxPQUFPLENBQUNDLEdBQUcsQ0FBQ0YsS0FBSyxDQUFDRyxNQUFNLENBQUNDLE9BQU8sQ0FBQztNQUNqQ0gsT0FBTyxDQUFDQyxHQUFHLENBQUNGLEtBQUssQ0FBQ0csTUFBTSxDQUFDRSxPQUFPLENBQUM7TUFDakNKLE9BQU8sQ0FBQ0MsR0FBRyxDQUFDRixLQUFLLENBQUNHLE1BQU0sQ0FBQ0csR0FBRyxDQUFDO01BRTdCTixLQUFLLENBQUNHLE1BQU0sQ0FBQ0csR0FBRyxDQUFDVixnQkFBZ0IsQ0FBQyxTQUFTLEVBQUUsWUFBWTtRQUNyREssT0FBTyxDQUFDQyxHQUFHLENBQUMsd0JBQXdCLENBQUM7TUFDekMsQ0FBQyxDQUFDO0lBQ047RUFBQztFQUFBLE9BQUFuQixRQUFBO0FBQUEsRUFsQndCRCxpREFBVTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQ0ZQO0FBQ0s7O0FBRXJDO0FBQ0EsSUFBSTRCLGdCQUFnQixHQUFHQyxRQUFRLENBQUNDLGFBQWEsQ0FBQyxjQUFjLENBQUM7QUFDN0QsSUFBSUMsV0FBVyxHQUFHRixRQUFRLENBQUNDLGFBQWEsQ0FBQyxlQUFlLENBQUM7QUFFekQsSUFBSUYsZ0JBQWdCLElBQUksSUFBSSxJQUFJRyxXQUFXLElBQUksSUFBSSxFQUFFO0VBQUEsSUFnR3BDQyxjQUFjLEdBQXZCLFNBQVNBLGNBQWNBLENBQUEsRUFBRztJQUN0QkMsZUFBZSxDQUFDQyxXQUFXLENBQUNDLGlCQUFpQixFQUFFQyxpQkFBaUIsQ0FBQztFQUNyRSxDQUFDO0VBQUEsSUFFUUMsZUFBZSxHQUF4QixTQUFTQSxlQUFlQSxDQUFBLEVBQUc7SUFDdkJDLGdCQUFnQixDQUNYQyxHQUFHLENBQUMsa0JBQWtCLEVBQUUsYUFBYSxDQUFDLENBQ3RDTCxXQUFXLENBQUMsZUFBZSxDQUFDLENBQzVCSyxHQUFHLENBQUMsT0FBTyxFQUFFLG1CQUFtQixDQUFDLENBQ2pDQyxNQUFNLENBQUMsT0FBTyxDQUFDO0VBQ3hCLENBQUM7RUFBQSxJQUVRQyxhQUFhLEdBQXRCLFNBQVNBLGFBQWFBLENBQUEsRUFBRztJQUNyQixJQUFJQyxZQUFZLENBQUNDLE1BQU0sS0FBSyxDQUFDLEVBQUU7TUFDM0JDLFFBQVEsQ0FBQ0MsTUFBTSxDQUFDLENBQUM7SUFDckI7RUFDSixDQUFDO0VBOUdELElBQUlDLEtBQUssR0FBR0MsQ0FBQyxDQUFDLE1BQU0sQ0FBQztFQUNyQixJQUFJQyxVQUFVLEdBQUdELENBQUMsQ0FBQyw2QkFBNkIsQ0FBQztFQUNqRCxJQUFJRSxNQUFNLEdBQUdGLENBQUMsQ0FBQyxRQUFRLENBQUMsQ0FBQ0csTUFBTSxDQUFDLEtBQUssQ0FBQztFQUN0QyxJQUFJQyxhQUFhLEdBQUdKLENBQUMsQ0FBQyxLQUFLLENBQUMsQ0FBQ0csTUFBTSxDQUFDLFNBQVMsQ0FBQztFQUM5QyxJQUFJWixnQkFBZ0IsR0FBR1MsQ0FBQyxDQUFDLEtBQUssQ0FBQyxDQUFDRyxNQUFNLENBQUMsS0FBSyxDQUFDO0VBQzdDLElBQUlFLGlCQUFpQixHQUFHTCxDQUFDLENBQUMsY0FBYyxDQUFDLENBQUNHLE1BQU0sQ0FBQyxRQUFRLENBQUM7RUFDMUQsSUFBSUcsa0JBQWtCLEdBQUdOLENBQUMsQ0FBQyxxQkFBcUIsQ0FBQyxDQUFDRyxNQUFNLENBQUMsS0FBSyxDQUFDO0VBQy9ELElBQUlqQixlQUFlLEdBQUdjLENBQUMsQ0FBQyxpQkFBaUIsQ0FBQyxDQUFDRyxNQUFNLENBQUMsR0FBRyxDQUFDO0VBQ3RELElBQUlmLGlCQUFpQixHQUFHLFdBQVc7RUFDbkMsSUFBSUMsaUJBQWlCLEdBQUcsd0JBQXdCO0VBQ2hELElBQUlrQixNQUFNLEdBQUcsR0FBRyxHQUFHSCxhQUFhLENBQUNJLEtBQUssQ0FBQyxDQUFDLEdBQUdKLGFBQWEsQ0FBQ0ssTUFBTSxDQUFDLENBQUMsQ0FBQ0QsS0FBSyxDQUFDLENBQUM7RUFDekUsSUFBSUUsYUFBYSxHQUFHVixDQUFDLENBQUMsZ0JBQWdCLENBQUMsQ0FBQ0csTUFBTSxDQUFDLEtBQUssQ0FBQztFQUNyRCxJQUFJUixZQUFZLEdBQUdLLENBQUMsQ0FBQyxxQkFBcUIsQ0FBQyxDQUFDRyxNQUFNLENBQUMsS0FBSyxDQUFDO0VBQ3pELElBQUlSLFlBQVksQ0FBQ0MsTUFBTSxLQUFLLENBQUMsRUFBRTtJQUMzQixJQUFJQyxRQUFRLEdBQUcsSUFBSWpCLHVEQUFPLENBQUMsZUFBZSxFQUFFO01BQ3hDO01BQ0ErQixZQUFZLEVBQUU7SUFDbEIsQ0FBQyxDQUFDO0lBQ0ZkLFFBQVEsQ0FBQ0MsTUFBTSxDQUFDLENBQUM7RUFDckI7RUFFQSxJQUFJbkIscURBQVcsQ0FBQyxRQUFRLENBQUMsRUFBRTtJQUN2QitCLGFBQWEsQ0FBQ2xCLEdBQUcsQ0FBQyxPQUFPLEVBQUViLHFEQUFXLENBQUMsUUFBUSxDQUFDLENBQUM7SUFDakRlLGFBQWEsQ0FBQyxDQUFDO0VBQ25CLENBQUMsTUFBTTtJQUNIZ0IsYUFBYSxDQUFDbEIsR0FBRyxDQUFDLE9BQU8sRUFBRSxLQUFLLENBQUM7SUFDakNFLGFBQWEsQ0FBQyxDQUFDO0VBQ25CO0VBRUFXLGlCQUFpQixDQUFDUSxLQUFLLENBQUMsWUFBWTtJQUVoQyxJQUFJQyxJQUFJLENBQUNDLEtBQUssQ0FBQ1IsTUFBTSxDQUFDLEtBQUssR0FBRyxFQUFFO01BRTVCTixVQUFVLENBQUNlLElBQUksQ0FBQyxDQUFDO01BQ2pCWixhQUFhLENBQUNhLFdBQVcsQ0FBQywrQkFBK0IsQ0FBQyxDQUFDQyxRQUFRLENBQUMsNEJBQTRCLENBQUM7TUFDakdoQixNQUFNLENBQUNlLFdBQVcsQ0FBQywrQkFBK0IsQ0FBQyxDQUFDQyxRQUFRLENBQUMsNEJBQTRCLENBQUM7TUFFMUYzQixnQkFBZ0IsQ0FDWEMsR0FBRyxDQUFDLGtCQUFrQixFQUFFLGFBQWEsQ0FBQyxDQUN0Q0wsV0FBVyxDQUFDLGVBQWUsQ0FBQyxDQUM1QkssR0FBRyxDQUFDLE9BQU8sRUFBRSxtQkFBbUIsQ0FBQyxDQUNqQ0MsTUFBTSxDQUFDLE9BQU8sQ0FBQztNQUVwQlIsY0FBYyxDQUFDLENBQUM7TUFDaEJzQixNQUFNLEdBQUcsQ0FBQztJQUNkLENBQUMsTUFBTTtNQUNISCxhQUFhLENBQUNhLFdBQVcsQ0FBQyw0QkFBNEIsQ0FBQyxDQUFDQyxRQUFRLENBQUMsK0JBQStCLENBQUM7TUFDakdoQixNQUFNLENBQUNlLFdBQVcsQ0FBQyw0QkFBNEIsQ0FBQyxDQUFDQyxRQUFRLENBQUMsK0JBQStCLENBQUM7TUFDMUZqQixVQUFVLENBQUNrQixJQUFJLENBQUMsQ0FBQztNQUNqQjVCLGdCQUFnQixDQUNYSixXQUFXLENBQUMsZUFBZSxDQUFDLENBQzVCaUMsTUFBTSxDQUFDLFlBQVk7UUFDaEI3QixnQkFBZ0IsQ0FBQzhCLE9BQU8sQ0FBQztVQUFDQyxLQUFLLEVBQUU7UUFBUSxDQUFDLEVBQUUsR0FBRyxDQUFDO01BQ3BELENBQUMsRUFBRSxZQUFZO1FBQ1gvQixnQkFBZ0IsQ0FBQzhCLE9BQU8sQ0FBQztVQUFDQyxLQUFLLEVBQUU7UUFBQyxDQUFDLEVBQUUsR0FBRyxDQUFDO01BQzdDLENBQUMsQ0FBQztNQUdOL0IsZ0JBQWdCLENBQ1hDLEdBQUcsQ0FBQyxrQkFBa0IsRUFBRSxhQUFhLENBQUMsQ0FDdENMLFdBQVcsQ0FBQyxlQUFlLENBQUMsQ0FDNUJLLEdBQUcsQ0FBQyxPQUFPLEVBQUUsbUJBQW1CLENBQUMsQ0FDakNDLE1BQU0sQ0FBQyxPQUFPLENBQUM7TUFFcEJSLGNBQWMsQ0FBQyxDQUFDO01BRWhCc0IsTUFBTSxHQUFHLEdBQUc7SUFDaEI7SUFFQWIsYUFBYSxDQUFDLENBQUM7RUFFbkIsQ0FBQyxDQUFDO0VBRUZXLGlCQUFpQixDQUFDa0IsRUFBRSxDQUFDLGdCQUFnQixFQUFFLFlBQVk7SUFDL0N2QixDQUFDLENBQUMsaUJBQWlCLENBQUMsQ0FBQ3dCLE9BQU8sQ0FBQyxPQUFPLENBQUM7RUFDekMsQ0FBQyxDQUFDO0VBRUZ6QixLQUFLLENBQUMwQixRQUFRLENBQUMsVUFBVUMsQ0FBQyxFQUFFO0lBRXhCLElBQUlBLENBQUMsQ0FBQ0MsT0FBTyxLQUFLLEVBQUUsSUFBSXBCLE1BQU0sS0FBSyxHQUFHLEVBQUc7TUFDckNELGtCQUFrQixDQUFDc0IsS0FBSyxDQUFDLENBQUM7TUFDMUIzQixVQUFVLENBQUNlLElBQUksQ0FBQyxDQUFDO01BQ2pCWixhQUFhLENBQUNhLFdBQVcsQ0FBQywrQkFBK0IsQ0FBQyxDQUFDQyxRQUFRLENBQUMsNEJBQTRCLENBQUM7TUFFakc1QixlQUFlLENBQUMsQ0FBQztNQUNqQkwsY0FBYyxDQUFDLENBQUM7TUFFaEJTLGFBQWEsQ0FBQyxDQUFDO0lBQ25CO0lBRUFhLE1BQU0sR0FBRyxDQUFDO0VBQ2QsQ0FBQyxDQUFDO0FBb0JWOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUN4SGdDO0FBQ2Q7QUFDbEI7QUFDMkQ7O0FBRzNEOztBQUVBOztBQUVBO0FBQ0F1QixtQkFBTyxDQUFDLHlEQUF1QixDQUFDO0FBQ2hDQSxtQkFBTyxDQUFDLHFEQUFxQixDQUFDOztBQUc5QjtBQUNBO0FBQ0E7O0FBR0E7QUFDQUEsbUJBQU8sQ0FBQyw0RUFBK0IsQ0FBQztBQUN4QztBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQUEsbUJBQU8sQ0FBQyx3Q0FBVyxDQUFDO0FBQ3BCO0FBQ0E7QUFDQTtBQUNBQSxtQkFBTyxDQUFDLGdEQUFlLENBQUM7QUFFeEJDLEtBQUssQ0FBQ0MsSUFBSSxDQUFDbEQsUUFBUSxDQUFDbUQsZ0JBQWdCLENBQUMsUUFBUSxDQUFDLENBQUMsQ0FDMUNDLE9BQU8sQ0FBQyxVQUFBQyxTQUFTO0VBQUEsT0FBSSxJQUFJTixzRUFBSyxDQUFDTSxTQUFTLENBQUMsQ0FBQ25CLElBQUksQ0FBQyxDQUFDO0FBQUEsRUFBQzs7Ozs7Ozs7OztBQ25DdERvQixNQUFNLENBQUNDLE1BQU0sR0FBRyxZQUFZO0VBQzVCRCxNQUFNLENBQUNyRSxnQkFBZ0IsQ0FBQyxNQUFNLEVBQUUsVUFBQ0ksS0FBSyxFQUFLO0lBQ3ZDLElBQU1tRSxNQUFNLEdBQUd4RCxRQUFRLENBQUN5RCxHQUFHLENBQUNOLGdCQUFnQixDQUFDLFVBQVUsQ0FBQztJQUN4RCxJQUFNTyxXQUFXLEdBQUcxRCxRQUFRLENBQUNtRCxnQkFBZ0IsQ0FBQyxLQUFLLENBQUM7SUFFcERHLE1BQU0sQ0FBQ0ssTUFBTSxHQUFHLFlBQVk7TUFDeEIsSUFBSSxJQUFJLENBQUNDLE9BQU8sR0FBRyxHQUFHLEVBQUU7UUFDcEJKLE1BQU0sQ0FBQ0ssTUFBTSxDQUFDLEdBQUcsQ0FBQztRQUNsQkgsV0FBVyxDQUFDaEQsR0FBRyxDQUFDO1VBQUMsa0JBQWtCLEVBQUU7UUFBUyxDQUFDLENBQUM7TUFDcEQsQ0FBQyxNQUFNO1FBQ0g4QyxNQUFNLENBQUNNLE9BQU8sQ0FBQyxHQUFHLENBQUM7UUFDbkJKLFdBQVcsQ0FBQ2hELEdBQUcsQ0FBQztVQUFDLGtCQUFrQixFQUFFO1FBQWEsQ0FBQyxDQUFDO01BQ3hEO0lBQ0osQ0FBQztJQUVEOEMsTUFBTSxDQUFDekIsS0FBSyxDQUFDLFlBQVk7TUFDckJnQyxJQUFJLENBQUNDLFNBQVMsQ0FBQztRQUNYSixPQUFPLEVBQUU7TUFDYixDQUFDLEVBQUUsQ0FBQyxDQUFDO01BQ0wsT0FBTyxLQUFLO0lBQ2hCLENBQUMsQ0FBQztJQUNGRixXQUFXLENBQUMzQixLQUFLLENBQUMsWUFBWTtNQUMxQmdDLElBQUksQ0FBQ0MsU0FBUyxDQUFDO1FBQ1hKLE9BQU8sRUFBRTtNQUNiLENBQUMsRUFBRSxDQUFDLENBQUM7TUFDTCxPQUFPLEtBQUs7SUFDaEIsQ0FBQyxDQUFDO0VBQ04sQ0FBQyxDQUFDO0FBQ0YsQ0FBQzs7Ozs7Ozs7Ozs7Ozs7OztBQzVCMkQ7O0FBRTVEO0FBQ08sSUFBTU0sR0FBRyxHQUFHRCwwRUFBZ0IsQ0FBQ2pCLDJJQUluQyxDQUFDOzs7Ozs7Ozs7Ozs7QUNQRjs7Ozs7Ozs7Ozs7OztBQ0FBOzs7Ozs7O1VDQUE7VUFDQTs7VUFFQTtVQUNBO1VBQ0E7VUFDQTtVQUNBO1VBQ0E7VUFDQTtVQUNBO1VBQ0E7VUFDQTtVQUNBO1VBQ0E7VUFDQTs7VUFFQTtVQUNBOztVQUVBO1VBQ0E7VUFDQTs7VUFFQTtVQUNBOzs7OztXQ3pCQTtXQUNBO1dBQ0E7V0FDQTtXQUNBLCtCQUErQix3Q0FBd0M7V0FDdkU7V0FDQTtXQUNBO1dBQ0E7V0FDQSxpQkFBaUIscUJBQXFCO1dBQ3RDO1dBQ0E7V0FDQSxrQkFBa0IscUJBQXFCO1dBQ3ZDO1dBQ0E7V0FDQSxLQUFLO1dBQ0w7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBOzs7OztXQzNCQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0EsaUNBQWlDLFdBQVc7V0FDNUM7V0FDQTs7Ozs7V0NQQTtXQUNBO1dBQ0E7V0FDQTtXQUNBLHlDQUF5Qyx3Q0FBd0M7V0FDakY7V0FDQTtXQUNBOzs7OztXQ1BBO1dBQ0E7V0FDQTtXQUNBO1dBQ0EsR0FBRztXQUNIO1dBQ0E7V0FDQSxDQUFDOzs7OztXQ1BEOzs7OztXQ0FBO1dBQ0E7V0FDQTtXQUNBLHVEQUF1RCxpQkFBaUI7V0FDeEU7V0FDQSxnREFBZ0QsYUFBYTtXQUM3RDs7Ozs7V0NOQTs7V0FFQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7O1dBRUE7O1dBRUE7O1dBRUE7O1dBRUE7O1dBRUE7O1dBRUE7O1dBRUE7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0EsTUFBTSxxQkFBcUI7V0FDM0I7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTs7V0FFQTtXQUNBO1dBQ0E7Ozs7O1VFaERBO1VBQ0E7VUFDQTtVQUNBO1VBQ0EiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9pc3BvbnNvci8gXFwuKGolN0N0KXN4Iiwid2VicGFjazovL2lzcG9uc29yLy4vYXNzZXQvY29udHJvbGxlcnMvY3JvcHBlcl9jb250cm9sbGVyLmpzIiwid2VicGFjazovL2lzcG9uc29yLy4vYXNzZXQvanMvZnVsbF9zY3JlZW4uanMiLCJ3ZWJwYWNrOi8vaXNwb25zb3IvLi9hc3NldC9qcy9ob21lcGFnZS5qcyIsIndlYnBhY2s6Ly9pc3BvbnNvci8uL2Fzc2V0L2pzL21vdmVfdXAuanMiLCJ3ZWJwYWNrOi8vaXNwb25zb3IvLi9hc3NldC9zdGltdWx1c19icmlkZ2VfaW5pdC5qcyIsIndlYnBhY2s6Ly9pc3BvbnNvci8uL2Fzc2V0L2Nzcy9ob21lcGFnZS5jc3M/OTMyNiIsIndlYnBhY2s6Ly9pc3BvbnNvci8uL2Fzc2V0L3Njc3MvaG9tZXBhZ2Uuc2NzcyIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL2Jvb3RzdHJhcCIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL3J1bnRpbWUvY2h1bmsgbG9hZGVkIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9jb21wYXQgZ2V0IGRlZmF1bHQgZXhwb3J0Iiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9kZWZpbmUgcHJvcGVydHkgZ2V0dGVycyIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL3J1bnRpbWUvZ2xvYmFsIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9oYXNPd25Qcm9wZXJ0eSBzaG9ydGhhbmQiLCJ3ZWJwYWNrOi8vaXNwb25zb3Ivd2VicGFjay9ydW50aW1lL21ha2UgbmFtZXNwYWNlIG9iamVjdCIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL3J1bnRpbWUvanNvbnAgY2h1bmsgbG9hZGluZyIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL2JlZm9yZS1zdGFydHVwIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svc3RhcnR1cCIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL2FmdGVyLXN0YXJ0dXAiXSwic291cmNlc0NvbnRlbnQiOlsidmFyIG1hcCA9IHtcblx0XCIuL2Nyb3BwZXJfY29udHJvbGxlci5qc1wiOiBcIi4vbm9kZV9tb2R1bGVzL0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyLmpzIS4vYXNzZXQvY29udHJvbGxlcnMvY3JvcHBlcl9jb250cm9sbGVyLmpzXCJcbn07XG5cblxuZnVuY3Rpb24gd2VicGFja0NvbnRleHQocmVxKSB7XG5cdHZhciBpZCA9IHdlYnBhY2tDb250ZXh0UmVzb2x2ZShyZXEpO1xuXHRyZXR1cm4gX193ZWJwYWNrX3JlcXVpcmVfXyhpZCk7XG59XG5mdW5jdGlvbiB3ZWJwYWNrQ29udGV4dFJlc29sdmUocmVxKSB7XG5cdGlmKCFfX3dlYnBhY2tfcmVxdWlyZV9fLm8obWFwLCByZXEpKSB7XG5cdFx0dmFyIGUgPSBuZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiICsgcmVxICsgXCInXCIpO1xuXHRcdGUuY29kZSA9ICdNT0RVTEVfTk9UX0ZPVU5EJztcblx0XHR0aHJvdyBlO1xuXHR9XG5cdHJldHVybiBtYXBbcmVxXTtcbn1cbndlYnBhY2tDb250ZXh0LmtleXMgPSBmdW5jdGlvbiB3ZWJwYWNrQ29udGV4dEtleXMoKSB7XG5cdHJldHVybiBPYmplY3Qua2V5cyhtYXApO1xufTtcbndlYnBhY2tDb250ZXh0LnJlc29sdmUgPSB3ZWJwYWNrQ29udGV4dFJlc29sdmU7XG5tb2R1bGUuZXhwb3J0cyA9IHdlYnBhY2tDb250ZXh0O1xud2VicGFja0NvbnRleHQuaWQgPSBcIi4vYXNzZXQvY29udHJvbGxlcnMgc3luYyByZWN1cnNpdmUgLi9ub2RlX21vZHVsZXMvQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIuanMhIFxcXFwuKGolN0N0KXN4PyRcIjsiLCJpbXBvcnQgeyBDb250cm9sbGVyIH0gZnJvbSAnc3RpbXVsdXMnO1xuXG5leHBvcnQgZGVmYXVsdCBjbGFzcyBleHRlbmRzIENvbnRyb2xsZXIge1xuICAgIGNvbm5lY3QoKSB7XG4gICAgICAgIHRoaXMuZWxlbWVudC5hZGRFdmVudExpc3RlbmVyKCdjcm9wcGVyanM6Y29ubmVjdCcsIHRoaXMuX29uQ29ubmVjdCk7XG4gICAgfVxuXG4gICAgZGlzY29ubmVjdCgpIHtcbiAgICAgICAgLy8gWW91IHNob3VsZCBhbHdheXMgcmVtb3ZlIGxpc3RlbmVycyB3aGVuIHRoZSBjb250cm9sbGVyIGlzIGRpc2Nvbm5lY3RlZCB0byBhdm9pZCBzaWRlIGVmZmVjdHNcbiAgICAgICAgdGhpcy5lbGVtZW50LnJlbW92ZUV2ZW50TGlzdGVuZXIoJ2Nyb3BwZXJqczpjb25uZWN0JywgdGhpcy5fb25Db25uZWN0KTtcbiAgICB9XG5cbiAgICBfb25Db25uZWN0KGV2ZW50KSB7XG4gICAgICAgIGNvbnNvbGUubG9nKGV2ZW50LmRldGFpbC5jcm9wcGVyKTtcbiAgICAgICAgY29uc29sZS5sb2coZXZlbnQuZGV0YWlsLm9wdGlvbnMpO1xuICAgICAgICBjb25zb2xlLmxvZyhldmVudC5kZXRhaWwuaW1nKTtcblxuICAgICAgICBldmVudC5kZXRhaWwuaW1nLmFkZEV2ZW50TGlzdGVuZXIoJ2Nyb3BlbmQnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBjb25zb2xlLmxvZyhcImVuZGVkIGNyb2pvcGFtbmRranduYmRcIilcbiAgICAgICAgfSk7XG4gICAgfVxufVxuIiwiaW1wb3J0IENvb2tpZXMgZnJvbSAnanMtY29va2llJztcclxuaW1wb3J0IE1hc29ucnkgZnJvbSAnbWFzb25yeS1sYXlvdXQnO1xyXG5cclxuLy9sZXQgZ3JpZCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNtYXNvbnJ5LWdyaWQnKTtcclxubGV0IGZ1bGxTY3JlZW5CdXR0b24gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjZnVsbC1zY3JlZW4nKTtcclxubGV0IG1hc29ucnlHcmlkID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI21hc29ucnktZ3JpZCcpO1xyXG5cclxuaWYgKGZ1bGxTY3JlZW5CdXR0b24gIT0gbnVsbCAmJiBtYXNvbnJ5R3JpZCAhPSBudWxsKSB7XHJcblxyXG4gICAgICAgIGxldCAkaHRtbCA9ICQoJ2h0bWwnKTtcclxuICAgICAgICBsZXQgJGhpZGVBcnJheSA9ICQoJyNiMSwgI2IyLCAjaGVhZGVyLCAjcDEsICNwMicpO1xyXG4gICAgICAgIGxldCAkcGFuZWwgPSAkKCcjcGFuZWwnKS5maWx0ZXIoJ2RpdicpO1xyXG4gICAgICAgIGxldCAkY29udGVudEJsb2NrID0gJCgnI2IzJykuZmlsdGVyKCdhcnRpY2xlJyk7XHJcbiAgICAgICAgbGV0ICRhc2lkZVJpZ2h0UGFuZWwgPSAkKCcjYjQnKS5maWx0ZXIoJ2RpdicpO1xyXG4gICAgICAgIGxldCAkZnVsbFNjcmVlbkJ1dHRvbiA9ICQoJyNmdWxsLXNjcmVlbicpLmZpbHRlcignYnV0dG9uJyk7XHJcbiAgICAgICAgbGV0ICRmdWxsU2NyZWVuTWVzc2FnZSA9ICQoJyNmdWxsc2NyZWVuLW1lc3NhZ2UnKS5maWx0ZXIoJ2RpdicpO1xyXG4gICAgICAgIGxldCAkZnVsbFNjcmVlbkljb24gPSAkKCcjZmEtZnVsbC1zY3JlZW4nKS5maWx0ZXIoJ2knKTtcclxuICAgICAgICBsZXQgJGZ1bGxTY3JJY29uQ2xhc3MgPSAnZmEtYXJyb3dzJztcclxuICAgICAgICBsZXQgJGZ1bGxTY3JJY29uUHJlc3MgPSAnZmEtY29tcHJlc3MtYXJyb3dzLWFsdCc7XHJcbiAgICAgICAgbGV0ICR3aWR0aCA9IDEwMCAqICRjb250ZW50QmxvY2sud2lkdGgoKSAvICRjb250ZW50QmxvY2sucGFyZW50KCkud2lkdGgoKTtcclxuICAgICAgICBsZXQgJG1hc29ucnlCcmljayA9ICQoJy5tYXNvbnJ5LWJyaWNrJykuZmlsdGVyKCdkaXYnKTtcclxuICAgICAgICBsZXQgJG1hc29ucnlHcmlkID0gJCgnI21hc29ucnktZ3JpZDpmaXJzdCcpLmZpbHRlcignZGl2Jyk7XHJcbiAgICAgICAgaWYgKCRtYXNvbnJ5R3JpZC5sZW5ndGggIT09IDApIHtcclxuICAgICAgICAgICAgdmFyICRtYXNvbnJ5ID0gbmV3IE1hc29ucnkoJyNtYXNvbnJ5LWdyaWQnLCB7XHJcbiAgICAgICAgICAgICAgICAvLyBvcHRpb25zLi4uXHJcbiAgICAgICAgICAgICAgICBpdGVtU2VsZWN0b3I6ICcubWFzb25yeS1icmljaycsXHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgICAkbWFzb25yeS5sYXlvdXQoKTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIGlmIChDb29raWVzLmdldCgnc2NyZWVuJykpIHtcclxuICAgICAgICAgICAgJG1hc29ucnlCcmljay5jc3MoJ3dpZHRoJywgQ29va2llcy5nZXQoJ3NjcmVlbicpKTtcclxuICAgICAgICAgICAgbWFzb25yeUxheW91dCgpO1xyXG4gICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgICRtYXNvbnJ5QnJpY2suY3NzKCd3aWR0aCcsICcyNSUnKTtcclxuICAgICAgICAgICAgbWFzb25yeUxheW91dCgpO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJGZ1bGxTY3JlZW5CdXR0b24uY2xpY2soZnVuY3Rpb24gKCkge1xyXG5cclxuICAgICAgICAgICAgaWYgKE1hdGgucm91bmQoJHdpZHRoKSA9PT0gMTAwKSB7XHJcblxyXG4gICAgICAgICAgICAgICAgJGhpZGVBcnJheS5zaG93KCk7XHJcbiAgICAgICAgICAgICAgICAkY29udGVudEJsb2NrLnJlbW92ZUNsYXNzKCdjb2wtbGctMTIgY29sLXNtLTEyIGNvbC1tZC0xMicpLmFkZENsYXNzKCdjb2wtbGctOCBjb2wtc20tNiBjb2wtbWQtOCcpO1xyXG4gICAgICAgICAgICAgICAgJHBhbmVsLnJlbW92ZUNsYXNzKCdjb2wtc20tMTIgY29sLW1kLTEyIGNvbC1sZy0xMicpLmFkZENsYXNzKCdjb2wtc20tNiBjb2wtbWQtOCBjb2wtbGctOCcpO1xyXG5cclxuICAgICAgICAgICAgICAgICRhc2lkZVJpZ2h0UGFuZWxcclxuICAgICAgICAgICAgICAgICAgICAuY3NzKCdiYWNrZ3JvdW5kLWNvbG9yJywgJ3RyYW5zcGFyZW50JylcclxuICAgICAgICAgICAgICAgICAgICAudG9nZ2xlQ2xhc3MoJ2Fic29sdXRlcGFuZWwnKVxyXG4gICAgICAgICAgICAgICAgICAgIC5jc3MoJ3JpZ2h0JywgJ2luaGVyaXQhaW1wb3J0YW50JylcclxuICAgICAgICAgICAgICAgICAgICAudW5iaW5kKCdjbGljaycpO1xyXG5cclxuICAgICAgICAgICAgICAgIGZ1bGxTY3JlZW5JY29uKCk7XHJcbiAgICAgICAgICAgICAgICAkd2lkdGggPSAwO1xyXG4gICAgICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAgICAgJGNvbnRlbnRCbG9jay5yZW1vdmVDbGFzcygnY29sLWxnLTggY29sLXNtLTYgY29sLW1kLTgnKS5hZGRDbGFzcygnY29sLWxnLTEyIGNvbC1zbS0xMiBjb2wtbWQtMTInKTtcclxuICAgICAgICAgICAgICAgICRwYW5lbC5yZW1vdmVDbGFzcygnY29sLXNtLTYgY29sLW1kLTggY29sLWxnLTgnKS5hZGRDbGFzcygnY29sLXNtLTEyIGNvbC1tZC0xMiBjb2wtbGctMTInKTtcclxuICAgICAgICAgICAgICAgICRoaWRlQXJyYXkuaGlkZSgpO1xyXG4gICAgICAgICAgICAgICAgJGFzaWRlUmlnaHRQYW5lbFxyXG4gICAgICAgICAgICAgICAgICAgIC50b2dnbGVDbGFzcygnYWJzb2x1dGVwYW5lbCcpXHJcbiAgICAgICAgICAgICAgICAgICAgLnRvZ2dsZShmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICRhc2lkZVJpZ2h0UGFuZWwuYW5pbWF0ZSh7cmlnaHQ6ICctMTY1cHgnfSwgNTAwKTtcclxuICAgICAgICAgICAgICAgICAgICB9LCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICRhc2lkZVJpZ2h0UGFuZWwuYW5pbWF0ZSh7cmlnaHQ6IDB9LCA1MDApO1xyXG4gICAgICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuXHJcbiAgICAgICAgICAgICAgICAkYXNpZGVSaWdodFBhbmVsXHJcbiAgICAgICAgICAgICAgICAgICAgLmNzcygnYmFja2dyb3VuZC1jb2xvcicsICd0cmFuc3BhcmVudCcpXHJcbiAgICAgICAgICAgICAgICAgICAgLnRvZ2dsZUNsYXNzKCdhYnNvbHV0ZXBhbmVsJylcclxuICAgICAgICAgICAgICAgICAgICAuY3NzKCdyaWdodCcsICdpbmhlcml0IWltcG9ydGFudCcpXHJcbiAgICAgICAgICAgICAgICAgICAgLnVuYmluZCgnY2xpY2snKTtcclxuXHJcbiAgICAgICAgICAgICAgICBmdWxsU2NyZWVuSWNvbigpO1xyXG5cclxuICAgICAgICAgICAgICAgICR3aWR0aCA9IDEwMDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgbWFzb25yeUxheW91dCgpO1xyXG5cclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgJGZ1bGxTY3JlZW5CdXR0b24ub24oJ3Nob3duLmJzLm1vZGFsJywgZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICAkKCcjc2F2ZUZ1bGxTY3JlZW4nKS50cmlnZ2VyKCdmb2N1cycpXHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICRodG1sLmtleXByZXNzKGZ1bmN0aW9uIChlKSB7XHJcblxyXG4gICAgICAgICAgICBpZiAoZS5rZXlDb2RlID09PSAyNyAmJiAkd2lkdGggPT09IDEwMCApIHtcclxuICAgICAgICAgICAgICAgICRmdWxsU2NyZWVuTWVzc2FnZS5tb2RhbCgpO1xyXG4gICAgICAgICAgICAgICAgJGhpZGVBcnJheS5zaG93KCk7XHJcbiAgICAgICAgICAgICAgICAkY29udGVudEJsb2NrLnJlbW92ZUNsYXNzKCdjb2wtbGctMTIgY29sLXNtLTEyIGNvbC1tZC0xMicpLmFkZENsYXNzKCdjb2wtbGctOCBjb2wtc20tNiBjb2wtbWQtOCcpO1xyXG5cclxuICAgICAgICAgICAgICAgIGFzaWRlUmlnaHRQYW5lbCgpO1xyXG4gICAgICAgICAgICAgICAgZnVsbFNjcmVlbkljb24oKTtcclxuXHJcbiAgICAgICAgICAgICAgICBtYXNvbnJ5TGF5b3V0KCk7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICR3aWR0aCA9IDA7XHJcbiAgICAgICAgfSk7XHJcblxyXG5cclxuICAgICAgICBmdW5jdGlvbiBmdWxsU2NyZWVuSWNvbigpIHtcclxuICAgICAgICAgICAgJGZ1bGxTY3JlZW5JY29uLnRvZ2dsZUNsYXNzKCRmdWxsU2NySWNvbkNsYXNzLCAkZnVsbFNjckljb25QcmVzcyk7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBmdW5jdGlvbiBhc2lkZVJpZ2h0UGFuZWwoKSB7XHJcbiAgICAgICAgICAgICRhc2lkZVJpZ2h0UGFuZWxcclxuICAgICAgICAgICAgICAgIC5jc3MoJ2JhY2tncm91bmQtY29sb3InLCAndHJhbnNwYXJlbnQnKVxyXG4gICAgICAgICAgICAgICAgLnRvZ2dsZUNsYXNzKCdhYnNvbHV0ZXBhbmVsJylcclxuICAgICAgICAgICAgICAgIC5jc3MoJ3JpZ2h0JywgJ2luaGVyaXQhaW1wb3J0YW50JylcclxuICAgICAgICAgICAgICAgIC51bmJpbmQoJ2NsaWNrJyk7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBmdW5jdGlvbiBtYXNvbnJ5TGF5b3V0KCkge1xyXG4gICAgICAgICAgICBpZiAoJG1hc29ucnlHcmlkLmxlbmd0aCAhPT0gMCkge1xyXG4gICAgICAgICAgICAgICAgJG1hc29ucnkubGF5b3V0KCk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbn1cclxuIiwiaW1wb3J0ICcuLi9zdGltdWx1c19icmlkZ2VfaW5pdCdcbmltcG9ydCAnYm9vdHN0cmFwJ1xuLy9pbXBvcnQgJ2Jvb3RzdHJhcC9kaXN0L2pzL2Jvb3RzdHJhcC5idW5kbGUubWluJ1xuaW1wb3J0IHsgVG9hc3QgfSBmcm9tICdib290c3RyYXAvZGlzdC9qcy9ib290c3RyYXAuZXNtLm1pbidcblxuXG4vL3JlcXVpcmUoJ2Jvb3RzdHJhcC1hdXRvaGlkZS1uYXZiYXInKTtcblxuLy8gcmVxdWlyZSgnc21hcnR3aXphcmQnKTtcblxuLy9yZXF1aXJlKCdtYXNvbnJ5LWxheW91dCcpO1xucmVxdWlyZSgnLi4vc2Nzcy9ob21lcGFnZS5zY3NzJyk7XG5yZXF1aXJlKCcuLi9jc3MvaG9tZXBhZ2UuY3NzJyk7XG5cblxuLy9pbXBvcnQoJy4vbWFzb25yeV9pbml0LmpzJyk7XG4vL2ltcG9ydCgnLi4vY3NzL2FwcC5jc3MnKTtcbi8vIGltcG9ydCgnLi4vY3NzL25hdmJhci5jc3MnKTtcblxuXG4vLyAvL3JlcXVpcmUoJy4uL2Nzcy9saWtlTWFzb25yeUNhcnQuY3NzJyk7XG5yZXF1aXJlKCcuLi9mb250YXdlc29tZS1wcm8vanMvYWxsLm1pbicpO1xuLy8gcmVxdWlyZSgnLi9hdXRvX2hpZGluZ19uYXZiYXJfaW5pdCcpO1xuLy8gcmVxdWlyZSgnLi9ib290c3RyYXAtdGFncy1pbnB1dC1pbml0Jyk7XG4vLyByZXF1aXJlKCcuL2NhcnQuanMnKTtcbi8vIC8vcmVxdWlyZSgnLi9tdWx0aXN0ZXBfZm9ybScpO1xuLy8gcmVxdWlyZSgnLi90aW55bWNlX2luaXQnKTtcbi8vIHJlcXVpcmUoJy4vc21hcnR3aXphcmRfaW5pdCcpO1xucmVxdWlyZSgnLi9tb3ZlX3VwJyk7XG4vLyAvL3JlcXVpcmUoJy4vbWFzb25yeV9pbml0Jyk7XG4vLyByZXF1aXJlKCcuL2NvbHNfcGVyX3JvdycpO1xuLy8gcmVxdWlyZSgnLi9hZGQtY29sbGVjdGlvbi13aWRnZXQnKTtcbnJlcXVpcmUoJy4vZnVsbF9zY3JlZW4nKTtcblxuQXJyYXkuZnJvbShkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcudG9hc3QnKSlcbiAgICAuZm9yRWFjaCh0b2FzdE5vZGUgPT4gbmV3IFRvYXN0KHRvYXN0Tm9kZSkuc2hvdygpKTtcbiIsIndpbmRvdy5vbmxvYWQgPSBmdW5jdGlvbiAoKSB7XG53aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignbG9hZCcsIChldmVudCkgPT4ge1xuICAgIGNvbnN0IG1vdmVVcCA9IGRvY3VtZW50LmRpdi5xdWVyeVNlbGVjdG9yQWxsKFwiI21vdmVfdXBcIilcbiAgICBjb25zdCBtb3ZlVXBCbG9jayA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoXCIjYjFcIilcblxuICAgIHdpbmRvdy5zY3JvbGwgPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGlmICh0aGlzLnNjcm9sbFkgPiA0MDApIHtcbiAgICAgICAgICAgIG1vdmVVcC5mYWRlSW4oNjAwKTtcbiAgICAgICAgICAgIG1vdmVVcEJsb2NrLmNzcyh7J2JhY2tncm91bmQtY29sb3InOiAnI2NmY2ZjZid9KTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIG1vdmVVcC5mYWRlT3V0KDYwMCk7XG4gICAgICAgICAgICBtb3ZlVXBCbG9jay5jc3MoeydiYWNrZ3JvdW5kLWNvbG9yJzogJ3RyYW5zcGFyZW50J30pO1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgbW92ZVVwLmNsaWNrKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgaHRtbC5zY3JvbGxUb3Aoe1xuICAgICAgICAgICAgc2Nyb2xsWTogMFxuICAgICAgICB9LCAwKTtcbiAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgIH0pO1xuICAgIG1vdmVVcEJsb2NrLmNsaWNrKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgaHRtbC5zY3JvbGxUb3Aoe1xuICAgICAgICAgICAgc2Nyb2xsWTogMFxuICAgICAgICB9LCAwKTtcbiAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgIH0pO1xufSlcbn1cblxuXG5cblxuXG4iLCJpbXBvcnQgeyBzdGFydFN0aW11bHVzQXBwIH0gZnJvbSAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlJztcblxuLy8gUmVnaXN0ZXJzIFN0aW11bHVzIGNvbnRyb2xsZXJzIGZyb20gY29udHJvbGxlcnMuanNvbiBhbmQgaW4gdGhlIGNvbnRyb2xsZXJzLyBkaXJlY3RvcnlcbmV4cG9ydCBjb25zdCBhcHAgPSBzdGFydFN0aW11bHVzQXBwKHJlcXVpcmUuY29udGV4dChcbiAgICAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIhLi9jb250cm9sbGVycycsXG4gICAgdHJ1ZSxcbiAgICAvXFwuKGp8dClzeD8kL1xuKSk7XG4iLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiLCIvLyBUaGUgbW9kdWxlIGNhY2hlXG52YXIgX193ZWJwYWNrX21vZHVsZV9jYWNoZV9fID0ge307XG5cbi8vIFRoZSByZXF1aXJlIGZ1bmN0aW9uXG5mdW5jdGlvbiBfX3dlYnBhY2tfcmVxdWlyZV9fKG1vZHVsZUlkKSB7XG5cdC8vIENoZWNrIGlmIG1vZHVsZSBpcyBpbiBjYWNoZVxuXHR2YXIgY2FjaGVkTW9kdWxlID0gX193ZWJwYWNrX21vZHVsZV9jYWNoZV9fW21vZHVsZUlkXTtcblx0aWYgKGNhY2hlZE1vZHVsZSAhPT0gdW5kZWZpbmVkKSB7XG5cdFx0cmV0dXJuIGNhY2hlZE1vZHVsZS5leHBvcnRzO1xuXHR9XG5cdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG5cdHZhciBtb2R1bGUgPSBfX3dlYnBhY2tfbW9kdWxlX2NhY2hlX19bbW9kdWxlSWRdID0ge1xuXHRcdC8vIG5vIG1vZHVsZS5pZCBuZWVkZWRcblx0XHQvLyBubyBtb2R1bGUubG9hZGVkIG5lZWRlZFxuXHRcdGV4cG9ydHM6IHt9XG5cdH07XG5cblx0Ly8gRXhlY3V0ZSB0aGUgbW9kdWxlIGZ1bmN0aW9uXG5cdF9fd2VicGFja19tb2R1bGVzX19bbW9kdWxlSWRdLmNhbGwobW9kdWxlLmV4cG9ydHMsIG1vZHVsZSwgbW9kdWxlLmV4cG9ydHMsIF9fd2VicGFja19yZXF1aXJlX18pO1xuXG5cdC8vIFJldHVybiB0aGUgZXhwb3J0cyBvZiB0aGUgbW9kdWxlXG5cdHJldHVybiBtb2R1bGUuZXhwb3J0cztcbn1cblxuLy8gZXhwb3NlIHRoZSBtb2R1bGVzIG9iamVjdCAoX193ZWJwYWNrX21vZHVsZXNfXylcbl9fd2VicGFja19yZXF1aXJlX18ubSA9IF9fd2VicGFja19tb2R1bGVzX187XG5cbiIsInZhciBkZWZlcnJlZCA9IFtdO1xuX193ZWJwYWNrX3JlcXVpcmVfXy5PID0gKHJlc3VsdCwgY2h1bmtJZHMsIGZuLCBwcmlvcml0eSkgPT4ge1xuXHRpZihjaHVua0lkcykge1xuXHRcdHByaW9yaXR5ID0gcHJpb3JpdHkgfHwgMDtcblx0XHRmb3IodmFyIGkgPSBkZWZlcnJlZC5sZW5ndGg7IGkgPiAwICYmIGRlZmVycmVkW2kgLSAxXVsyXSA+IHByaW9yaXR5OyBpLS0pIGRlZmVycmVkW2ldID0gZGVmZXJyZWRbaSAtIDFdO1xuXHRcdGRlZmVycmVkW2ldID0gW2NodW5rSWRzLCBmbiwgcHJpb3JpdHldO1xuXHRcdHJldHVybjtcblx0fVxuXHR2YXIgbm90RnVsZmlsbGVkID0gSW5maW5pdHk7XG5cdGZvciAodmFyIGkgPSAwOyBpIDwgZGVmZXJyZWQubGVuZ3RoOyBpKyspIHtcblx0XHR2YXIgW2NodW5rSWRzLCBmbiwgcHJpb3JpdHldID0gZGVmZXJyZWRbaV07XG5cdFx0dmFyIGZ1bGZpbGxlZCA9IHRydWU7XG5cdFx0Zm9yICh2YXIgaiA9IDA7IGogPCBjaHVua0lkcy5sZW5ndGg7IGorKykge1xuXHRcdFx0aWYgKChwcmlvcml0eSAmIDEgPT09IDAgfHwgbm90RnVsZmlsbGVkID49IHByaW9yaXR5KSAmJiBPYmplY3Qua2V5cyhfX3dlYnBhY2tfcmVxdWlyZV9fLk8pLmV2ZXJ5KChrZXkpID0+IChfX3dlYnBhY2tfcmVxdWlyZV9fLk9ba2V5XShjaHVua0lkc1tqXSkpKSkge1xuXHRcdFx0XHRjaHVua0lkcy5zcGxpY2Uoai0tLCAxKTtcblx0XHRcdH0gZWxzZSB7XG5cdFx0XHRcdGZ1bGZpbGxlZCA9IGZhbHNlO1xuXHRcdFx0XHRpZihwcmlvcml0eSA8IG5vdEZ1bGZpbGxlZCkgbm90RnVsZmlsbGVkID0gcHJpb3JpdHk7XG5cdFx0XHR9XG5cdFx0fVxuXHRcdGlmKGZ1bGZpbGxlZCkge1xuXHRcdFx0ZGVmZXJyZWQuc3BsaWNlKGktLSwgMSlcblx0XHRcdHZhciByID0gZm4oKTtcblx0XHRcdGlmIChyICE9PSB1bmRlZmluZWQpIHJlc3VsdCA9IHI7XG5cdFx0fVxuXHR9XG5cdHJldHVybiByZXN1bHQ7XG59OyIsIi8vIGdldERlZmF1bHRFeHBvcnQgZnVuY3Rpb24gZm9yIGNvbXBhdGliaWxpdHkgd2l0aCBub24taGFybW9ueSBtb2R1bGVzXG5fX3dlYnBhY2tfcmVxdWlyZV9fLm4gPSAobW9kdWxlKSA9PiB7XG5cdHZhciBnZXR0ZXIgPSBtb2R1bGUgJiYgbW9kdWxlLl9fZXNNb2R1bGUgP1xuXHRcdCgpID0+IChtb2R1bGVbJ2RlZmF1bHQnXSkgOlxuXHRcdCgpID0+IChtb2R1bGUpO1xuXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQoZ2V0dGVyLCB7IGE6IGdldHRlciB9KTtcblx0cmV0dXJuIGdldHRlcjtcbn07IiwiLy8gZGVmaW5lIGdldHRlciBmdW5jdGlvbnMgZm9yIGhhcm1vbnkgZXhwb3J0c1xuX193ZWJwYWNrX3JlcXVpcmVfXy5kID0gKGV4cG9ydHMsIGRlZmluaXRpb24pID0+IHtcblx0Zm9yKHZhciBrZXkgaW4gZGVmaW5pdGlvbikge1xuXHRcdGlmKF9fd2VicGFja19yZXF1aXJlX18ubyhkZWZpbml0aW9uLCBrZXkpICYmICFfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZXhwb3J0cywga2V5KSkge1xuXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIGtleSwgeyBlbnVtZXJhYmxlOiB0cnVlLCBnZXQ6IGRlZmluaXRpb25ba2V5XSB9KTtcblx0XHR9XG5cdH1cbn07IiwiX193ZWJwYWNrX3JlcXVpcmVfXy5nID0gKGZ1bmN0aW9uKCkge1xuXHRpZiAodHlwZW9mIGdsb2JhbFRoaXMgPT09ICdvYmplY3QnKSByZXR1cm4gZ2xvYmFsVGhpcztcblx0dHJ5IHtcblx0XHRyZXR1cm4gdGhpcyB8fCBuZXcgRnVuY3Rpb24oJ3JldHVybiB0aGlzJykoKTtcblx0fSBjYXRjaCAoZSkge1xuXHRcdGlmICh0eXBlb2Ygd2luZG93ID09PSAnb2JqZWN0JykgcmV0dXJuIHdpbmRvdztcblx0fVxufSkoKTsiLCJfX3dlYnBhY2tfcmVxdWlyZV9fLm8gPSAob2JqLCBwcm9wKSA9PiAoT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsKG9iaiwgcHJvcCkpIiwiLy8gZGVmaW5lIF9fZXNNb2R1bGUgb24gZXhwb3J0c1xuX193ZWJwYWNrX3JlcXVpcmVfXy5yID0gKGV4cG9ydHMpID0+IHtcblx0aWYodHlwZW9mIFN5bWJvbCAhPT0gJ3VuZGVmaW5lZCcgJiYgU3ltYm9sLnRvU3RyaW5nVGFnKSB7XG5cdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIFN5bWJvbC50b1N0cmluZ1RhZywgeyB2YWx1ZTogJ01vZHVsZScgfSk7XG5cdH1cblx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsICdfX2VzTW9kdWxlJywgeyB2YWx1ZTogdHJ1ZSB9KTtcbn07IiwiLy8gbm8gYmFzZVVSSVxuXG4vLyBvYmplY3QgdG8gc3RvcmUgbG9hZGVkIGFuZCBsb2FkaW5nIGNodW5rc1xuLy8gdW5kZWZpbmVkID0gY2h1bmsgbm90IGxvYWRlZCwgbnVsbCA9IGNodW5rIHByZWxvYWRlZC9wcmVmZXRjaGVkXG4vLyBbcmVzb2x2ZSwgcmVqZWN0LCBQcm9taXNlXSA9IGNodW5rIGxvYWRpbmcsIDAgPSBjaHVuayBsb2FkZWRcbnZhciBpbnN0YWxsZWRDaHVua3MgPSB7XG5cdFwiaG9tZXBhZ2VcIjogMFxufTtcblxuLy8gbm8gY2h1bmsgb24gZGVtYW5kIGxvYWRpbmdcblxuLy8gbm8gcHJlZmV0Y2hpbmdcblxuLy8gbm8gcHJlbG9hZGVkXG5cbi8vIG5vIEhNUlxuXG4vLyBubyBITVIgbWFuaWZlc3RcblxuX193ZWJwYWNrX3JlcXVpcmVfXy5PLmogPSAoY2h1bmtJZCkgPT4gKGluc3RhbGxlZENodW5rc1tjaHVua0lkXSA9PT0gMCk7XG5cbi8vIGluc3RhbGwgYSBKU09OUCBjYWxsYmFjayBmb3IgY2h1bmsgbG9hZGluZ1xudmFyIHdlYnBhY2tKc29ucENhbGxiYWNrID0gKHBhcmVudENodW5rTG9hZGluZ0Z1bmN0aW9uLCBkYXRhKSA9PiB7XG5cdHZhciBbY2h1bmtJZHMsIG1vcmVNb2R1bGVzLCBydW50aW1lXSA9IGRhdGE7XG5cdC8vIGFkZCBcIm1vcmVNb2R1bGVzXCIgdG8gdGhlIG1vZHVsZXMgb2JqZWN0LFxuXHQvLyB0aGVuIGZsYWcgYWxsIFwiY2h1bmtJZHNcIiBhcyBsb2FkZWQgYW5kIGZpcmUgY2FsbGJhY2tcblx0dmFyIG1vZHVsZUlkLCBjaHVua0lkLCBpID0gMDtcblx0aWYoY2h1bmtJZHMuc29tZSgoaWQpID0+IChpbnN0YWxsZWRDaHVua3NbaWRdICE9PSAwKSkpIHtcblx0XHRmb3IobW9kdWxlSWQgaW4gbW9yZU1vZHVsZXMpIHtcblx0XHRcdGlmKF9fd2VicGFja19yZXF1aXJlX18ubyhtb3JlTW9kdWxlcywgbW9kdWxlSWQpKSB7XG5cdFx0XHRcdF9fd2VicGFja19yZXF1aXJlX18ubVttb2R1bGVJZF0gPSBtb3JlTW9kdWxlc1ttb2R1bGVJZF07XG5cdFx0XHR9XG5cdFx0fVxuXHRcdGlmKHJ1bnRpbWUpIHZhciByZXN1bHQgPSBydW50aW1lKF9fd2VicGFja19yZXF1aXJlX18pO1xuXHR9XG5cdGlmKHBhcmVudENodW5rTG9hZGluZ0Z1bmN0aW9uKSBwYXJlbnRDaHVua0xvYWRpbmdGdW5jdGlvbihkYXRhKTtcblx0Zm9yKDtpIDwgY2h1bmtJZHMubGVuZ3RoOyBpKyspIHtcblx0XHRjaHVua0lkID0gY2h1bmtJZHNbaV07XG5cdFx0aWYoX193ZWJwYWNrX3JlcXVpcmVfXy5vKGluc3RhbGxlZENodW5rcywgY2h1bmtJZCkgJiYgaW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdKSB7XG5cdFx0XHRpbnN0YWxsZWRDaHVua3NbY2h1bmtJZF1bMF0oKTtcblx0XHR9XG5cdFx0aW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdID0gMDtcblx0fVxuXHRyZXR1cm4gX193ZWJwYWNrX3JlcXVpcmVfXy5PKHJlc3VsdCk7XG59XG5cbnZhciBjaHVua0xvYWRpbmdHbG9iYWwgPSBzZWxmW1wid2VicGFja0NodW5raXNwb25zb3JcIl0gPSBzZWxmW1wid2VicGFja0NodW5raXNwb25zb3JcIl0gfHwgW107XG5jaHVua0xvYWRpbmdHbG9iYWwuZm9yRWFjaCh3ZWJwYWNrSnNvbnBDYWxsYmFjay5iaW5kKG51bGwsIDApKTtcbmNodW5rTG9hZGluZ0dsb2JhbC5wdXNoID0gd2VicGFja0pzb25wQ2FsbGJhY2suYmluZChudWxsLCBjaHVua0xvYWRpbmdHbG9iYWwucHVzaC5iaW5kKGNodW5rTG9hZGluZ0dsb2JhbCkpOyIsIiIsIi8vIHN0YXJ0dXBcbi8vIExvYWQgZW50cnkgbW9kdWxlIGFuZCByZXR1cm4gZXhwb3J0c1xuLy8gVGhpcyBlbnRyeSBtb2R1bGUgZGVwZW5kcyBvbiBvdGhlciBsb2FkZWQgY2h1bmtzIGFuZCBleGVjdXRpb24gbmVlZCB0byBiZSBkZWxheWVkXG52YXIgX193ZWJwYWNrX2V4cG9ydHNfXyA9IF9fd2VicGFja19yZXF1aXJlX18uTyh1bmRlZmluZWQsIFtcInZlbmRvcnMtbm9kZV9tb2R1bGVzX3BvcHBlcmpzX2NvcmVfbGliX2luZGV4X2pzLW5vZGVfbW9kdWxlc19jb3JlLWpzX2ludGVybmFsc19hLWNvbnN0cnVjdG9yXy1lODZmOWRcIixcInZlbmRvcnMtbm9kZV9tb2R1bGVzX2Jvb3RzdHJhcF9kaXN0X2pzX2Jvb3RzdHJhcF9lc21fanNcIixcInZlbmRvcnMtbm9kZV9tb2R1bGVzX2NvcmUtanNfbW9kdWxlc19lc19hcnJheV9jb25jYXRfanMtbm9kZV9tb2R1bGVzX2NvcmUtanNfbW9kdWxlc19lc19hcnJheS0yMDQxNjJcIixcInZlbmRvcnMtbm9kZV9tb2R1bGVzX2Jvb3RzdHJhcF9kaXN0X2pzX2Jvb3RzdHJhcF9lc21fbWluX2pzXCIsXCJ2ZW5kb3JzLW5vZGVfbW9kdWxlc19zeW1mb255X3N0aW11bHVzLWJyaWRnZV9kaXN0X2luZGV4X2pzLW5vZGVfbW9kdWxlc19jb3JlLWpzX21vZHVsZXNfZXNfZGEtOTIwOWVkXCIsXCJ2ZW5kb3JzLW5vZGVfbW9kdWxlc19tYXNvbnJ5LWxheW91dF9tYXNvbnJ5X2pzLW5vZGVfbW9kdWxlc19qcy1jb29raWVfZGlzdF9qc19jb29raWVfbWpzXCIsXCJhc3NldF9mb250YXdlc29tZS1wcm9fanNfYWxsX21pbl9qc1wiXSwgKCkgPT4gKF9fd2VicGFja19yZXF1aXJlX18oXCIuL2Fzc2V0L2pzL2hvbWVwYWdlLmpzXCIpKSlcbl9fd2VicGFja19leHBvcnRzX18gPSBfX3dlYnBhY2tfcmVxdWlyZV9fLk8oX193ZWJwYWNrX2V4cG9ydHNfXyk7XG4iLCIiXSwibmFtZXMiOlsiQ29udHJvbGxlciIsIl9kZWZhdWx0IiwiX0NvbnRyb2xsZXIiLCJfaW5oZXJpdHMiLCJfc3VwZXIiLCJfY3JlYXRlU3VwZXIiLCJfY2xhc3NDYWxsQ2hlY2siLCJhcHBseSIsImFyZ3VtZW50cyIsIl9jcmVhdGVDbGFzcyIsImtleSIsInZhbHVlIiwiY29ubmVjdCIsImVsZW1lbnQiLCJhZGRFdmVudExpc3RlbmVyIiwiX29uQ29ubmVjdCIsImRpc2Nvbm5lY3QiLCJyZW1vdmVFdmVudExpc3RlbmVyIiwiZXZlbnQiLCJjb25zb2xlIiwibG9nIiwiZGV0YWlsIiwiY3JvcHBlciIsIm9wdGlvbnMiLCJpbWciLCJkZWZhdWx0IiwiQ29va2llcyIsIk1hc29ucnkiLCJmdWxsU2NyZWVuQnV0dG9uIiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yIiwibWFzb25yeUdyaWQiLCJmdWxsU2NyZWVuSWNvbiIsIiRmdWxsU2NyZWVuSWNvbiIsInRvZ2dsZUNsYXNzIiwiJGZ1bGxTY3JJY29uQ2xhc3MiLCIkZnVsbFNjckljb25QcmVzcyIsImFzaWRlUmlnaHRQYW5lbCIsIiRhc2lkZVJpZ2h0UGFuZWwiLCJjc3MiLCJ1bmJpbmQiLCJtYXNvbnJ5TGF5b3V0IiwiJG1hc29ucnlHcmlkIiwibGVuZ3RoIiwiJG1hc29ucnkiLCJsYXlvdXQiLCIkaHRtbCIsIiQiLCIkaGlkZUFycmF5IiwiJHBhbmVsIiwiZmlsdGVyIiwiJGNvbnRlbnRCbG9jayIsIiRmdWxsU2NyZWVuQnV0dG9uIiwiJGZ1bGxTY3JlZW5NZXNzYWdlIiwiJHdpZHRoIiwid2lkdGgiLCJwYXJlbnQiLCIkbWFzb25yeUJyaWNrIiwiaXRlbVNlbGVjdG9yIiwiZ2V0IiwiY2xpY2siLCJNYXRoIiwicm91bmQiLCJzaG93IiwicmVtb3ZlQ2xhc3MiLCJhZGRDbGFzcyIsImhpZGUiLCJ0b2dnbGUiLCJhbmltYXRlIiwicmlnaHQiLCJvbiIsInRyaWdnZXIiLCJrZXlwcmVzcyIsImUiLCJrZXlDb2RlIiwibW9kYWwiLCJUb2FzdCIsInJlcXVpcmUiLCJBcnJheSIsImZyb20iLCJxdWVyeVNlbGVjdG9yQWxsIiwiZm9yRWFjaCIsInRvYXN0Tm9kZSIsIndpbmRvdyIsIm9ubG9hZCIsIm1vdmVVcCIsImRpdiIsIm1vdmVVcEJsb2NrIiwic2Nyb2xsIiwic2Nyb2xsWSIsImZhZGVJbiIsImZhZGVPdXQiLCJodG1sIiwic2Nyb2xsVG9wIiwic3RhcnRTdGltdWx1c0FwcCIsImFwcCIsImNvbnRleHQiXSwic291cmNlUm9vdCI6IiJ9