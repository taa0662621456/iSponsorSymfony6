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

/***/ "./asset/js/auto_hiding_navbar_init.js":
/*!*********************************************!*\
  !*** ./asset/js/auto_hiding_navbar_init.js ***!
  \*********************************************/
/***/ (() => {

/*('nav.navbar-fixed-top').bootstrapAutoHideNavbar({
        disableAutoHide: false,
        delta: 5,
        duration: 250,
        shadow: true
    }
)*/

/***/ }),

/***/ "./asset/js/base.js":
/*!**************************!*\
  !*** ./asset/js/base.js ***!
  \**************************/
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
/* harmony import */ var _stimulus_bridge_init__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../stimulus_bridge_init */ "./asset/stimulus_bridge_init.js");
/* harmony import */ var bootstrap_dist_js_bootstrap_bundle_min__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! bootstrap/dist/js/bootstrap.bundle.min */ "./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js");
/* harmony import */ var bootstrap_dist_js_bootstrap_bundle_min__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(bootstrap_dist_js_bootstrap_bundle_min__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var bootstrap_js_dist_popover__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! bootstrap/js/dist/popover */ "./node_modules/bootstrap/js/dist/popover.js");
/* harmony import */ var bootstrap_js_dist_popover__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(bootstrap_js_dist_popover__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var bootstrap_dist_js_bootstrap_esm_min__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! bootstrap/dist/js/bootstrap.esm.min */ "./node_modules/bootstrap/dist/js/bootstrap.esm.min.js");













//require('bootstrap');
//require('bootstrap-autohide-navbar');

//require('masonry-layout');
__webpack_require__(/*! ../scss/base.scss */ "./asset/scss/base.scss");
__webpack_require__(/*! ../css/base.css */ "./asset/css/base.css");

//import('./masonry_init.js');
//import('../css/app.css');
__webpack_require__.e(/*! import() */ "asset_css_navbar_css").then(__webpack_require__.bind(__webpack_require__, /*! ../css/navbar.css */ "./asset/css/navbar.css"));

//require('./dropdown-toggle_init'); //TODO: использует jQuery; необходимо альтернативное решение
//require('../css/likeMasonryCart.css');
__webpack_require__(/*! ../fontawesome-pro/js/all.min */ "./asset/fontawesome-pro/js/all.min.js");
__webpack_require__(/*! ./auto_hiding_navbar_init */ "./asset/js/auto_hiding_navbar_init.js");
// require('./bootstrap-tags-input-init');
// require('./cart.js');
//require('./multistep_form'); //TODO: использует jQuery; помечено на удаление
//require('./tinymce_init');
__webpack_require__(/*! ./move_up */ "./asset/js/move_up.js");
//require('./masonry_init');
// require('./cols_per_row');
// require('./add-collection-widget');
__webpack_require__(/*! ./full_screen */ "./asset/js/full_screen.js");
__webpack_require__(/*! ./form_links_add_and_rem */ "./asset/js/form_links_add_and_rem.js");
Array.from(document.querySelectorAll('.toast')).forEach(function (toastNode) {
  return new bootstrap_dist_js_bootstrap_esm_min__WEBPACK_IMPORTED_MODULE_11__.Toast(toastNode).show();
});

/***/ }),

/***/ "./asset/js/form_links_add_and_rem.js":
/*!********************************************!*\
  !*** ./asset/js/form_links_add_and_rem.js ***!
  \********************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
__webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
__webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
__webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
var prototypeHolder = document.getElementById('project_stepThree_projectAttachments');
var collectionPlace = prototypeHolder;
var addFormToCollection = function addFormToCollection(e) {
  var prototypeHolder = document.querySelector('.' + e.target.dataset.collectionHolderClass);
  var item = document.createElement('div');
  item.classList.add('item');
  var items = document.querySelectorAll('div.item');
  items.forEach(function (tag) {
    addTagFormDeleteLink(tag);
  });
  item.innerHTML = prototypeHolder.dataset.prototype.replace(/__name__/g, prototypeHolder.dataset.index);
  collectionPlace.appendChild(item);
  prototypeHolder.dataset.index++;
};
var items = document.querySelectorAll('div.item');
items.forEach(function (tag) {
  addTagFormDeleteLink(tag);
});
var remFormCollection = function remFormCollection(item) {
  var removeButton = document.querySelectorAll('.rem_item_link');
  var items = document.querySelectorAll('div.item');
  items.forEach(function (tag) {
    addTagFormDeleteLink(tag);
  });
  removeButton.addEventListener('click', function (e) {
    e.preventDefault();
    items.remove();
  });
};
document.querySelectorAll('.add_item_link').forEach(function (btn) {
  return btn.addEventListener("click", addFormToCollection);
});
document.querySelectorAll('.rem_item_link').forEach(function (btn) {
  return btn.addEventListener("click", remFormCollection);
});

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

/***/ "./asset/css/base.css":
/*!****************************!*\
  !*** ./asset/css/base.css ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./asset/scss/base.scss":
/*!******************************!*\
  !*** ./asset/scss/base.scss ***!
  \******************************/
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
/******/ 			"base": 0
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
/******/ 			"base": 0,
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
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["vendors-node_modules_popperjs_core_lib_index_js-node_modules_core-js_internals_a-constructor_-e86f9d","vendors-node_modules_core-js_modules_es_array_concat_js-node_modules_core-js_modules_es_array-204162","vendors-node_modules_bootstrap_dist_js_bootstrap_esm_min_js","vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_core-js_modules_es_da-9209ed","vendors-node_modules_masonry-layout_masonry_js-node_modules_js-cookie_dist_js_cookie_mjs","vendors-node_modules_tinymce_skins_ui_oxide_content_min_css-node_modules_tinymce_skins_ui_oxi-29c70f","vendors-node_modules_bootstrap_dist_js_bootstrap_bundle_min_js-node_modules_bootstrap_js_dist-a46893","asset_fontawesome-pro_js_all_min_js"], () => (__webpack_require__("./asset/js/base.js")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTs7V0FFQTtXQUNBO1dBQ0E7V0FDQSxpQ0FBaUM7O1dBRWpDO1dBQ0E7V0FDQTtXQUNBLEtBQUs7V0FDTDtXQUNBO1dBQ0E7V0FDQTs7V0FFQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0EsTUFBTTtXQUNOO1dBQ0E7V0FDQTs7V0FFQTs7V0FFQTs7V0FFQTs7V0FFQTs7V0FFQTs7V0FFQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQSxNQUFNLHFCQUFxQjtXQUMzQjtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBOztXQUVBO1dBQ0E7V0FDQTs7Ozs7VUV0RkE7VUFDQTtVQUNBO1VBQ0E7VUFDQSIsInNvdXJjZXMiOlsid2VicGFjazovL2lzcG9uc29yLyBcXC4oaiU3Q3Qpc3giLCJ3ZWJwYWNrOi8vaXNwb25zb3IvLi9hc3NldC9jb250cm9sbGVycy9jcm9wcGVyX2NvbnRyb2xsZXIuanMiLCJ3ZWJwYWNrOi8vaXNwb25zb3IvLi9hc3NldC9qcy9hdXRvX2hpZGluZ19uYXZiYXJfaW5pdC5qcyIsIndlYnBhY2s6Ly9pc3BvbnNvci8uL2Fzc2V0L2pzL2Jhc2UuanMiLCJ3ZWJwYWNrOi8vaXNwb25zb3IvLi9hc3NldC9qcy9mb3JtX2xpbmtzX2FkZF9hbmRfcmVtLmpzIiwid2VicGFjazovL2lzcG9uc29yLy4vYXNzZXQvanMvZnVsbF9zY3JlZW4uanMiLCJ3ZWJwYWNrOi8vaXNwb25zb3IvLi9hc3NldC9qcy9tb3ZlX3VwLmpzIiwid2VicGFjazovL2lzcG9uc29yLy4vYXNzZXQvc3RpbXVsdXNfYnJpZGdlX2luaXQuanMiLCJ3ZWJwYWNrOi8vaXNwb25zb3IvLi9hc3NldC9jc3MvYmFzZS5jc3M/OTE5MyIsIndlYnBhY2s6Ly9pc3BvbnNvci8uL2Fzc2V0L3Njc3MvYmFzZS5zY3NzIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svYm9vdHN0cmFwIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9jaHVuayBsb2FkZWQiLCJ3ZWJwYWNrOi8vaXNwb25zb3Ivd2VicGFjay9ydW50aW1lL2NvbXBhdCBnZXQgZGVmYXVsdCBleHBvcnQiLCJ3ZWJwYWNrOi8vaXNwb25zb3Ivd2VicGFjay9ydW50aW1lL2RlZmluZSBwcm9wZXJ0eSBnZXR0ZXJzIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9lbnN1cmUgY2h1bmsiLCJ3ZWJwYWNrOi8vaXNwb25zb3Ivd2VicGFjay9ydW50aW1lL2dldCBqYXZhc2NyaXB0IGNodW5rIGZpbGVuYW1lIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9nZXQgbWluaS1jc3MgY2h1bmsgZmlsZW5hbWUiLCJ3ZWJwYWNrOi8vaXNwb25zb3Ivd2VicGFjay9ydW50aW1lL2dsb2JhbCIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL3J1bnRpbWUvaGFzT3duUHJvcGVydHkgc2hvcnRoYW5kIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9sb2FkIHNjcmlwdCIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL3J1bnRpbWUvbWFrZSBuYW1lc3BhY2Ugb2JqZWN0Iiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9wdWJsaWNQYXRoIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9jc3MgbG9hZGluZyIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL3J1bnRpbWUvanNvbnAgY2h1bmsgbG9hZGluZyIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL2JlZm9yZS1zdGFydHVwIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svc3RhcnR1cCIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL2FmdGVyLXN0YXJ0dXAiXSwic291cmNlc0NvbnRlbnQiOlsidmFyIG1hcCA9IHtcblx0XCIuL2Nyb3BwZXJfY29udHJvbGxlci5qc1wiOiBcIi4vbm9kZV9tb2R1bGVzL0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyLmpzIS4vYXNzZXQvY29udHJvbGxlcnMvY3JvcHBlcl9jb250cm9sbGVyLmpzXCJcbn07XG5cblxuZnVuY3Rpb24gd2VicGFja0NvbnRleHQocmVxKSB7XG5cdHZhciBpZCA9IHdlYnBhY2tDb250ZXh0UmVzb2x2ZShyZXEpO1xuXHRyZXR1cm4gX193ZWJwYWNrX3JlcXVpcmVfXyhpZCk7XG59XG5mdW5jdGlvbiB3ZWJwYWNrQ29udGV4dFJlc29sdmUocmVxKSB7XG5cdGlmKCFfX3dlYnBhY2tfcmVxdWlyZV9fLm8obWFwLCByZXEpKSB7XG5cdFx0dmFyIGUgPSBuZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiICsgcmVxICsgXCInXCIpO1xuXHRcdGUuY29kZSA9ICdNT0RVTEVfTk9UX0ZPVU5EJztcblx0XHR0aHJvdyBlO1xuXHR9XG5cdHJldHVybiBtYXBbcmVxXTtcbn1cbndlYnBhY2tDb250ZXh0LmtleXMgPSBmdW5jdGlvbiB3ZWJwYWNrQ29udGV4dEtleXMoKSB7XG5cdHJldHVybiBPYmplY3Qua2V5cyhtYXApO1xufTtcbndlYnBhY2tDb250ZXh0LnJlc29sdmUgPSB3ZWJwYWNrQ29udGV4dFJlc29sdmU7XG5tb2R1bGUuZXhwb3J0cyA9IHdlYnBhY2tDb250ZXh0O1xud2VicGFja0NvbnRleHQuaWQgPSBcIi4vYXNzZXQvY29udHJvbGxlcnMgc3luYyByZWN1cnNpdmUgLi9ub2RlX21vZHVsZXMvQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIuanMhIFxcXFwuKGolN0N0KXN4PyRcIjsiLCJpbXBvcnQgeyBDb250cm9sbGVyIH0gZnJvbSAnc3RpbXVsdXMnO1xuXG5leHBvcnQgZGVmYXVsdCBjbGFzcyBleHRlbmRzIENvbnRyb2xsZXIge1xuICAgIGNvbm5lY3QoKSB7XG4gICAgICAgIHRoaXMuZWxlbWVudC5hZGRFdmVudExpc3RlbmVyKCdjcm9wcGVyanM6Y29ubmVjdCcsIHRoaXMuX29uQ29ubmVjdCk7XG4gICAgfVxuXG4gICAgZGlzY29ubmVjdCgpIHtcbiAgICAgICAgLy8gWW91IHNob3VsZCBhbHdheXMgcmVtb3ZlIGxpc3RlbmVycyB3aGVuIHRoZSBjb250cm9sbGVyIGlzIGRpc2Nvbm5lY3RlZCB0byBhdm9pZCBzaWRlIGVmZmVjdHNcbiAgICAgICAgdGhpcy5lbGVtZW50LnJlbW92ZUV2ZW50TGlzdGVuZXIoJ2Nyb3BwZXJqczpjb25uZWN0JywgdGhpcy5fb25Db25uZWN0KTtcbiAgICB9XG5cbiAgICBfb25Db25uZWN0KGV2ZW50KSB7XG4gICAgICAgIGNvbnNvbGUubG9nKGV2ZW50LmRldGFpbC5jcm9wcGVyKTtcbiAgICAgICAgY29uc29sZS5sb2coZXZlbnQuZGV0YWlsLm9wdGlvbnMpO1xuICAgICAgICBjb25zb2xlLmxvZyhldmVudC5kZXRhaWwuaW1nKTtcblxuICAgICAgICBldmVudC5kZXRhaWwuaW1nLmFkZEV2ZW50TGlzdGVuZXIoJ2Nyb3BlbmQnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBjb25zb2xlLmxvZyhcImVuZGVkIGNyb2pvcGFtbmRranduYmRcIilcbiAgICAgICAgfSk7XG4gICAgfVxufVxuIiwiLyooJ25hdi5uYXZiYXItZml4ZWQtdG9wJykuYm9vdHN0cmFwQXV0b0hpZGVOYXZiYXIoe1xyXG4gICAgICAgIGRpc2FibGVBdXRvSGlkZTogZmFsc2UsXHJcbiAgICAgICAgZGVsdGE6IDUsXHJcbiAgICAgICAgZHVyYXRpb246IDI1MCxcclxuICAgICAgICBzaGFkb3c6IHRydWVcclxuICAgIH1cclxuKSovXHJcbiIsImltcG9ydCAnLi4vc3RpbXVsdXNfYnJpZGdlX2luaXQnXG5pbXBvcnQgJ2Jvb3RzdHJhcC9kaXN0L2pzL2Jvb3RzdHJhcC5idW5kbGUubWluJ1xuaW1wb3J0ICdib290c3RyYXAvanMvZGlzdC9wb3BvdmVyJ1xuaW1wb3J0IHsgVG9hc3QgfSBmcm9tICdib290c3RyYXAvZGlzdC9qcy9ib290c3RyYXAuZXNtLm1pbidcblxuLy9yZXF1aXJlKCdib290c3RyYXAnKTtcbi8vcmVxdWlyZSgnYm9vdHN0cmFwLWF1dG9oaWRlLW5hdmJhcicpO1xuXG5cbi8vcmVxdWlyZSgnbWFzb25yeS1sYXlvdXQnKTtcbnJlcXVpcmUoJy4uL3Njc3MvYmFzZS5zY3NzJyk7XG5yZXF1aXJlKCcuLi9jc3MvYmFzZS5jc3MnKTtcblxuXG4vL2ltcG9ydCgnLi9tYXNvbnJ5X2luaXQuanMnKTtcbi8vaW1wb3J0KCcuLi9jc3MvYXBwLmNzcycpO1xuaW1wb3J0KCcuLi9jc3MvbmF2YmFyLmNzcycpO1xuXG4vL3JlcXVpcmUoJy4vZHJvcGRvd24tdG9nZ2xlX2luaXQnKTsgLy9UT0RPOiDQuNGB0L/QvtC70YzQt9GD0LXRgiBqUXVlcnk7INC90LXQvtCx0YXQvtC00LjQvNC+INCw0LvRjNGC0LXRgNC90LDRgtC40LLQvdC+0LUg0YDQtdGI0LXQvdC40LVcbi8vcmVxdWlyZSgnLi4vY3NzL2xpa2VNYXNvbnJ5Q2FydC5jc3MnKTtcbnJlcXVpcmUoJy4uL2ZvbnRhd2Vzb21lLXByby9qcy9hbGwubWluJyk7XG5yZXF1aXJlKCcuL2F1dG9faGlkaW5nX25hdmJhcl9pbml0Jyk7XG4vLyByZXF1aXJlKCcuL2Jvb3RzdHJhcC10YWdzLWlucHV0LWluaXQnKTtcbi8vIHJlcXVpcmUoJy4vY2FydC5qcycpO1xuLy9yZXF1aXJlKCcuL211bHRpc3RlcF9mb3JtJyk7IC8vVE9ETzog0LjRgdC/0L7Qu9GM0LfRg9C10YIgalF1ZXJ5OyDQv9C+0LzQtdGH0LXQvdC+INC90LAg0YPQtNCw0LvQtdC90LjQtVxuLy9yZXF1aXJlKCcuL3RpbnltY2VfaW5pdCcpO1xucmVxdWlyZSgnLi9tb3ZlX3VwJyk7XG4vL3JlcXVpcmUoJy4vbWFzb25yeV9pbml0Jyk7XG4vLyByZXF1aXJlKCcuL2NvbHNfcGVyX3JvdycpO1xuLy8gcmVxdWlyZSgnLi9hZGQtY29sbGVjdGlvbi13aWRnZXQnKTtcbnJlcXVpcmUoJy4vZnVsbF9zY3JlZW4nKVxucmVxdWlyZSgnLi9mb3JtX2xpbmtzX2FkZF9hbmRfcmVtJylcblxuXG5BcnJheS5mcm9tKGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy50b2FzdCcpKVxuICAgIC5mb3JFYWNoKHRvYXN0Tm9kZSA9PiBuZXcgVG9hc3QodG9hc3ROb2RlKS5zaG93KCkpO1xuIiwiY29uc3QgcHJvdG90eXBlSG9sZGVyID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3Byb2plY3Rfc3RlcFRocmVlX3Byb2plY3RBdHRhY2htZW50cycpXG5jb25zdCBjb2xsZWN0aW9uUGxhY2UgPSBwcm90b3R5cGVIb2xkZXJcblxuY29uc3QgYWRkRm9ybVRvQ29sbGVjdGlvbiA9IChlKSA9PiB7XG4gICAgY29uc3QgcHJvdG90eXBlSG9sZGVyID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLicgKyBlLnRhcmdldC5kYXRhc2V0LmNvbGxlY3Rpb25Ib2xkZXJDbGFzcyk7XG5cbiAgICBjb25zdCBpdGVtID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnZGl2Jyk7XG5cbiAgICBpdGVtLmNsYXNzTGlzdC5hZGQoJ2l0ZW0nKVxuXG4gICAgY29uc3QgaXRlbXMgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCdkaXYuaXRlbScpXG4gICAgaXRlbXMuZm9yRWFjaCgodGFnKSA9PiB7XG4gICAgICAgIGFkZFRhZ0Zvcm1EZWxldGVMaW5rKHRhZylcbiAgICB9KVxuXG4gICAgaXRlbS5pbm5lckhUTUwgPSBwcm90b3R5cGVIb2xkZXJcbiAgICAgICAgLmRhdGFzZXRcbiAgICAgICAgLnByb3RvdHlwZVxuICAgICAgICAucmVwbGFjZShcbiAgICAgICAgICAgIC9fX25hbWVfXy9nLFxuICAgICAgICAgICAgcHJvdG90eXBlSG9sZGVyXG4gICAgICAgICAgICAgICAgLmRhdGFzZXRcbiAgICAgICAgICAgICAgICAuaW5kZXhcbiAgICAgICAgKTtcblxuICAgIGNvbGxlY3Rpb25QbGFjZS5hcHBlbmRDaGlsZChpdGVtKTtcblxuICAgIHByb3RvdHlwZUhvbGRlclxuICAgICAgICAuZGF0YXNldFxuICAgICAgICAuaW5kZXgrKztcbn1cblxuY29uc3QgaXRlbXMgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCdkaXYuaXRlbScpXG5pdGVtcy5mb3JFYWNoKCh0YWcpID0+IHtcbiAgICBhZGRUYWdGb3JtRGVsZXRlTGluayh0YWcpXG59KVxuXG5jb25zdCByZW1Gb3JtQ29sbGVjdGlvbiA9IChpdGVtKSA9PiB7XG4gICAgY29uc3QgcmVtb3ZlQnV0dG9uID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLnJlbV9pdGVtX2xpbmsnKVxuXG4gICAgY29uc3QgaXRlbXMgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCdkaXYuaXRlbScpXG4gICAgaXRlbXMuZm9yRWFjaCgodGFnKSA9PiB7XG4gICAgICAgIGFkZFRhZ0Zvcm1EZWxldGVMaW5rKHRhZylcbiAgICB9KVxuXG4gICAgcmVtb3ZlQnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKGUpID0+IHtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpXG5cbiAgICAgICAgaXRlbXMucmVtb3ZlKClcbiAgICB9KVxufVxuXG5cbmRvY3VtZW50LlxucXVlcnlTZWxlY3RvckFsbCgnLmFkZF9pdGVtX2xpbmsnKVxuICAgIC5mb3JFYWNoKGJ0biA9PiBidG4uYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIGFkZEZvcm1Ub0NvbGxlY3Rpb24pKVxuXG5kb2N1bWVudC5cbnF1ZXJ5U2VsZWN0b3JBbGwoJy5yZW1faXRlbV9saW5rJylcbiAgICAuZm9yRWFjaChidG4gPT4gYnRuLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCByZW1Gb3JtQ29sbGVjdGlvbikpXG4iLCJpbXBvcnQgQ29va2llcyBmcm9tICdqcy1jb29raWUnO1xyXG5pbXBvcnQgTWFzb25yeSBmcm9tICdtYXNvbnJ5LWxheW91dCc7XHJcblxyXG4vL2xldCBncmlkID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI21hc29ucnktZ3JpZCcpO1xyXG5sZXQgZnVsbFNjcmVlbkJ1dHRvbiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNmdWxsLXNjcmVlbicpO1xyXG5sZXQgbWFzb25yeUdyaWQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjbWFzb25yeS1ncmlkJyk7XHJcblxyXG5pZiAoZnVsbFNjcmVlbkJ1dHRvbiAhPSBudWxsICYmIG1hc29ucnlHcmlkICE9IG51bGwpIHtcclxuXHJcbiAgICAgICAgbGV0ICRodG1sID0gJCgnaHRtbCcpO1xyXG4gICAgICAgIGxldCAkaGlkZUFycmF5ID0gJCgnI2IxLCAjYjIsICNoZWFkZXIsICNwMSwgI3AyJyk7XHJcbiAgICAgICAgbGV0ICRwYW5lbCA9ICQoJyNwYW5lbCcpLmZpbHRlcignZGl2Jyk7XHJcbiAgICAgICAgbGV0ICRjb250ZW50QmxvY2sgPSAkKCcjYjMnKS5maWx0ZXIoJ2FydGljbGUnKTtcclxuICAgICAgICBsZXQgJGFzaWRlUmlnaHRQYW5lbCA9ICQoJyNiNCcpLmZpbHRlcignZGl2Jyk7XHJcbiAgICAgICAgbGV0ICRmdWxsU2NyZWVuQnV0dG9uID0gJCgnI2Z1bGwtc2NyZWVuJykuZmlsdGVyKCdidXR0b24nKTtcclxuICAgICAgICBsZXQgJGZ1bGxTY3JlZW5NZXNzYWdlID0gJCgnI2Z1bGxzY3JlZW4tbWVzc2FnZScpLmZpbHRlcignZGl2Jyk7XHJcbiAgICAgICAgbGV0ICRmdWxsU2NyZWVuSWNvbiA9ICQoJyNmYS1mdWxsLXNjcmVlbicpLmZpbHRlcignaScpO1xyXG4gICAgICAgIGxldCAkZnVsbFNjckljb25DbGFzcyA9ICdmYS1hcnJvd3MnO1xyXG4gICAgICAgIGxldCAkZnVsbFNjckljb25QcmVzcyA9ICdmYS1jb21wcmVzcy1hcnJvd3MtYWx0JztcclxuICAgICAgICBsZXQgJHdpZHRoID0gMTAwICogJGNvbnRlbnRCbG9jay53aWR0aCgpIC8gJGNvbnRlbnRCbG9jay5wYXJlbnQoKS53aWR0aCgpO1xyXG4gICAgICAgIGxldCAkbWFzb25yeUJyaWNrID0gJCgnLm1hc29ucnktYnJpY2snKS5maWx0ZXIoJ2RpdicpO1xyXG4gICAgICAgIGxldCAkbWFzb25yeUdyaWQgPSAkKCcjbWFzb25yeS1ncmlkOmZpcnN0JykuZmlsdGVyKCdkaXYnKTtcclxuICAgICAgICBpZiAoJG1hc29ucnlHcmlkLmxlbmd0aCAhPT0gMCkge1xyXG4gICAgICAgICAgICB2YXIgJG1hc29ucnkgPSBuZXcgTWFzb25yeSgnI21hc29ucnktZ3JpZCcsIHtcclxuICAgICAgICAgICAgICAgIC8vIG9wdGlvbnMuLi5cclxuICAgICAgICAgICAgICAgIGl0ZW1TZWxlY3RvcjogJy5tYXNvbnJ5LWJyaWNrJyxcclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgICAgICRtYXNvbnJ5LmxheW91dCgpO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgaWYgKENvb2tpZXMuZ2V0KCdzY3JlZW4nKSkge1xyXG4gICAgICAgICAgICAkbWFzb25yeUJyaWNrLmNzcygnd2lkdGgnLCBDb29raWVzLmdldCgnc2NyZWVuJykpO1xyXG4gICAgICAgICAgICBtYXNvbnJ5TGF5b3V0KCk7XHJcbiAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgJG1hc29ucnlCcmljay5jc3MoJ3dpZHRoJywgJzI1JScpO1xyXG4gICAgICAgICAgICBtYXNvbnJ5TGF5b3V0KCk7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAkZnVsbFNjcmVlbkJ1dHRvbi5jbGljayhmdW5jdGlvbiAoKSB7XHJcblxyXG4gICAgICAgICAgICBpZiAoTWF0aC5yb3VuZCgkd2lkdGgpID09PSAxMDApIHtcclxuXHJcbiAgICAgICAgICAgICAgICAkaGlkZUFycmF5LnNob3coKTtcclxuICAgICAgICAgICAgICAgICRjb250ZW50QmxvY2sucmVtb3ZlQ2xhc3MoJ2NvbC1sZy0xMiBjb2wtc20tMTIgY29sLW1kLTEyJykuYWRkQ2xhc3MoJ2NvbC1sZy04IGNvbC1zbS02IGNvbC1tZC04Jyk7XHJcbiAgICAgICAgICAgICAgICAkcGFuZWwucmVtb3ZlQ2xhc3MoJ2NvbC1zbS0xMiBjb2wtbWQtMTIgY29sLWxnLTEyJykuYWRkQ2xhc3MoJ2NvbC1zbS02IGNvbC1tZC04IGNvbC1sZy04Jyk7XHJcblxyXG4gICAgICAgICAgICAgICAgJGFzaWRlUmlnaHRQYW5lbFxyXG4gICAgICAgICAgICAgICAgICAgIC5jc3MoJ2JhY2tncm91bmQtY29sb3InLCAndHJhbnNwYXJlbnQnKVxyXG4gICAgICAgICAgICAgICAgICAgIC50b2dnbGVDbGFzcygnYWJzb2x1dGVwYW5lbCcpXHJcbiAgICAgICAgICAgICAgICAgICAgLmNzcygncmlnaHQnLCAnaW5oZXJpdCFpbXBvcnRhbnQnKVxyXG4gICAgICAgICAgICAgICAgICAgIC51bmJpbmQoJ2NsaWNrJyk7XHJcblxyXG4gICAgICAgICAgICAgICAgZnVsbFNjcmVlbkljb24oKTtcclxuICAgICAgICAgICAgICAgICR3aWR0aCA9IDA7XHJcbiAgICAgICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgICAgICAkY29udGVudEJsb2NrLnJlbW92ZUNsYXNzKCdjb2wtbGctOCBjb2wtc20tNiBjb2wtbWQtOCcpLmFkZENsYXNzKCdjb2wtbGctMTIgY29sLXNtLTEyIGNvbC1tZC0xMicpO1xyXG4gICAgICAgICAgICAgICAgJHBhbmVsLnJlbW92ZUNsYXNzKCdjb2wtc20tNiBjb2wtbWQtOCBjb2wtbGctOCcpLmFkZENsYXNzKCdjb2wtc20tMTIgY29sLW1kLTEyIGNvbC1sZy0xMicpO1xyXG4gICAgICAgICAgICAgICAgJGhpZGVBcnJheS5oaWRlKCk7XHJcbiAgICAgICAgICAgICAgICAkYXNpZGVSaWdodFBhbmVsXHJcbiAgICAgICAgICAgICAgICAgICAgLnRvZ2dsZUNsYXNzKCdhYnNvbHV0ZXBhbmVsJylcclxuICAgICAgICAgICAgICAgICAgICAudG9nZ2xlKGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgJGFzaWRlUmlnaHRQYW5lbC5hbmltYXRlKHtyaWdodDogJy0xNjVweCd9LCA1MDApO1xyXG4gICAgICAgICAgICAgICAgICAgIH0sIGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgJGFzaWRlUmlnaHRQYW5lbC5hbmltYXRlKHtyaWdodDogMH0sIDUwMCk7XHJcbiAgICAgICAgICAgICAgICAgICAgfSk7XHJcblxyXG5cclxuICAgICAgICAgICAgICAgICRhc2lkZVJpZ2h0UGFuZWxcclxuICAgICAgICAgICAgICAgICAgICAuY3NzKCdiYWNrZ3JvdW5kLWNvbG9yJywgJ3RyYW5zcGFyZW50JylcclxuICAgICAgICAgICAgICAgICAgICAudG9nZ2xlQ2xhc3MoJ2Fic29sdXRlcGFuZWwnKVxyXG4gICAgICAgICAgICAgICAgICAgIC5jc3MoJ3JpZ2h0JywgJ2luaGVyaXQhaW1wb3J0YW50JylcclxuICAgICAgICAgICAgICAgICAgICAudW5iaW5kKCdjbGljaycpO1xyXG5cclxuICAgICAgICAgICAgICAgIGZ1bGxTY3JlZW5JY29uKCk7XHJcblxyXG4gICAgICAgICAgICAgICAgJHdpZHRoID0gMTAwO1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICBtYXNvbnJ5TGF5b3V0KCk7XHJcblxyXG4gICAgICAgIH0pO1xyXG5cclxuICAgICAgICAkZnVsbFNjcmVlbkJ1dHRvbi5vbignc2hvd24uYnMubW9kYWwnLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgICQoJyNzYXZlRnVsbFNjcmVlbicpLnRyaWdnZXIoJ2ZvY3VzJylcclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgJGh0bWwua2V5cHJlc3MoZnVuY3Rpb24gKGUpIHtcclxuXHJcbiAgICAgICAgICAgIGlmIChlLmtleUNvZGUgPT09IDI3ICYmICR3aWR0aCA9PT0gMTAwICkge1xyXG4gICAgICAgICAgICAgICAgJGZ1bGxTY3JlZW5NZXNzYWdlLm1vZGFsKCk7XHJcbiAgICAgICAgICAgICAgICAkaGlkZUFycmF5LnNob3coKTtcclxuICAgICAgICAgICAgICAgICRjb250ZW50QmxvY2sucmVtb3ZlQ2xhc3MoJ2NvbC1sZy0xMiBjb2wtc20tMTIgY29sLW1kLTEyJykuYWRkQ2xhc3MoJ2NvbC1sZy04IGNvbC1zbS02IGNvbC1tZC04Jyk7XHJcblxyXG4gICAgICAgICAgICAgICAgYXNpZGVSaWdodFBhbmVsKCk7XHJcbiAgICAgICAgICAgICAgICBmdWxsU2NyZWVuSWNvbigpO1xyXG5cclxuICAgICAgICAgICAgICAgIG1hc29ucnlMYXlvdXQoKTtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgJHdpZHRoID0gMDtcclxuICAgICAgICB9KTtcclxuXHJcblxyXG4gICAgICAgIGZ1bmN0aW9uIGZ1bGxTY3JlZW5JY29uKCkge1xyXG4gICAgICAgICAgICAkZnVsbFNjcmVlbkljb24udG9nZ2xlQ2xhc3MoJGZ1bGxTY3JJY29uQ2xhc3MsICRmdWxsU2NySWNvblByZXNzKTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIGZ1bmN0aW9uIGFzaWRlUmlnaHRQYW5lbCgpIHtcclxuICAgICAgICAgICAgJGFzaWRlUmlnaHRQYW5lbFxyXG4gICAgICAgICAgICAgICAgLmNzcygnYmFja2dyb3VuZC1jb2xvcicsICd0cmFuc3BhcmVudCcpXHJcbiAgICAgICAgICAgICAgICAudG9nZ2xlQ2xhc3MoJ2Fic29sdXRlcGFuZWwnKVxyXG4gICAgICAgICAgICAgICAgLmNzcygncmlnaHQnLCAnaW5oZXJpdCFpbXBvcnRhbnQnKVxyXG4gICAgICAgICAgICAgICAgLnVuYmluZCgnY2xpY2snKTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIGZ1bmN0aW9uIG1hc29ucnlMYXlvdXQoKSB7XHJcbiAgICAgICAgICAgIGlmICgkbWFzb25yeUdyaWQubGVuZ3RoICE9PSAwKSB7XHJcbiAgICAgICAgICAgICAgICAkbWFzb25yeS5sYXlvdXQoKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxufVxyXG4iLCJ3aW5kb3cub25sb2FkID0gZnVuY3Rpb24gKCkge1xud2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ2xvYWQnLCAoZXZlbnQpID0+IHtcbiAgICBjb25zdCBtb3ZlVXAgPSBkb2N1bWVudC5kaXYucXVlcnlTZWxlY3RvckFsbChcIiNtb3ZlX3VwXCIpXG4gICAgY29uc3QgbW92ZVVwQmxvY2sgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKFwiI2IxXCIpXG5cbiAgICB3aW5kb3cuc2Nyb2xsID0gZnVuY3Rpb24gKCkge1xuICAgICAgICBpZiAodGhpcy5zY3JvbGxZID4gNDAwKSB7XG4gICAgICAgICAgICBtb3ZlVXAuZmFkZUluKDYwMCk7XG4gICAgICAgICAgICBtb3ZlVXBCbG9jay5jc3MoeydiYWNrZ3JvdW5kLWNvbG9yJzogJyNjZmNmY2YnfSk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBtb3ZlVXAuZmFkZU91dCg2MDApO1xuICAgICAgICAgICAgbW92ZVVwQmxvY2suY3NzKHsnYmFja2dyb3VuZC1jb2xvcic6ICd0cmFuc3BhcmVudCd9KTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIG1vdmVVcC5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgICAgIGh0bWwuc2Nyb2xsVG9wKHtcbiAgICAgICAgICAgIHNjcm9sbFk6IDBcbiAgICAgICAgfSwgMCk7XG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICB9KTtcbiAgICBtb3ZlVXBCbG9jay5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgICAgIGh0bWwuc2Nyb2xsVG9wKHtcbiAgICAgICAgICAgIHNjcm9sbFk6IDBcbiAgICAgICAgfSwgMCk7XG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICB9KTtcbn0pXG59XG5cblxuXG5cblxuIiwiaW1wb3J0IHsgc3RhcnRTdGltdWx1c0FwcCB9IGZyb20gJ0BzeW1mb255L3N0aW11bHVzLWJyaWRnZSc7XG5cbi8vIFJlZ2lzdGVycyBTdGltdWx1cyBjb250cm9sbGVycyBmcm9tIGNvbnRyb2xsZXJzLmpzb24gYW5kIGluIHRoZSBjb250cm9sbGVycy8gZGlyZWN0b3J5XG5leHBvcnQgY29uc3QgYXBwID0gc3RhcnRTdGltdWx1c0FwcChyZXF1aXJlLmNvbnRleHQoXG4gICAgJ0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyIS4vY29udHJvbGxlcnMnLFxuICAgIHRydWUsXG4gICAgL1xcLihqfHQpc3g/JC9cbikpO1xuIiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307IiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307IiwiLy8gVGhlIG1vZHVsZSBjYWNoZVxudmFyIF9fd2VicGFja19tb2R1bGVfY2FjaGVfXyA9IHt9O1xuXG4vLyBUaGUgcmVxdWlyZSBmdW5jdGlvblxuZnVuY3Rpb24gX193ZWJwYWNrX3JlcXVpcmVfXyhtb2R1bGVJZCkge1xuXHQvLyBDaGVjayBpZiBtb2R1bGUgaXMgaW4gY2FjaGVcblx0dmFyIGNhY2hlZE1vZHVsZSA9IF9fd2VicGFja19tb2R1bGVfY2FjaGVfX1ttb2R1bGVJZF07XG5cdGlmIChjYWNoZWRNb2R1bGUgIT09IHVuZGVmaW5lZCkge1xuXHRcdHJldHVybiBjYWNoZWRNb2R1bGUuZXhwb3J0cztcblx0fVxuXHQvLyBDcmVhdGUgYSBuZXcgbW9kdWxlIChhbmQgcHV0IGl0IGludG8gdGhlIGNhY2hlKVxuXHR2YXIgbW9kdWxlID0gX193ZWJwYWNrX21vZHVsZV9jYWNoZV9fW21vZHVsZUlkXSA9IHtcblx0XHQvLyBubyBtb2R1bGUuaWQgbmVlZGVkXG5cdFx0Ly8gbm8gbW9kdWxlLmxvYWRlZCBuZWVkZWRcblx0XHRleHBvcnRzOiB7fVxuXHR9O1xuXG5cdC8vIEV4ZWN1dGUgdGhlIG1vZHVsZSBmdW5jdGlvblxuXHRfX3dlYnBhY2tfbW9kdWxlc19fW21vZHVsZUlkXS5jYWxsKG1vZHVsZS5leHBvcnRzLCBtb2R1bGUsIG1vZHVsZS5leHBvcnRzLCBfX3dlYnBhY2tfcmVxdWlyZV9fKTtcblxuXHQvLyBSZXR1cm4gdGhlIGV4cG9ydHMgb2YgdGhlIG1vZHVsZVxuXHRyZXR1cm4gbW9kdWxlLmV4cG9ydHM7XG59XG5cbi8vIGV4cG9zZSB0aGUgbW9kdWxlcyBvYmplY3QgKF9fd2VicGFja19tb2R1bGVzX18pXG5fX3dlYnBhY2tfcmVxdWlyZV9fLm0gPSBfX3dlYnBhY2tfbW9kdWxlc19fO1xuXG4iLCJ2YXIgZGVmZXJyZWQgPSBbXTtcbl9fd2VicGFja19yZXF1aXJlX18uTyA9IChyZXN1bHQsIGNodW5rSWRzLCBmbiwgcHJpb3JpdHkpID0+IHtcblx0aWYoY2h1bmtJZHMpIHtcblx0XHRwcmlvcml0eSA9IHByaW9yaXR5IHx8IDA7XG5cdFx0Zm9yKHZhciBpID0gZGVmZXJyZWQubGVuZ3RoOyBpID4gMCAmJiBkZWZlcnJlZFtpIC0gMV1bMl0gPiBwcmlvcml0eTsgaS0tKSBkZWZlcnJlZFtpXSA9IGRlZmVycmVkW2kgLSAxXTtcblx0XHRkZWZlcnJlZFtpXSA9IFtjaHVua0lkcywgZm4sIHByaW9yaXR5XTtcblx0XHRyZXR1cm47XG5cdH1cblx0dmFyIG5vdEZ1bGZpbGxlZCA9IEluZmluaXR5O1xuXHRmb3IgKHZhciBpID0gMDsgaSA8IGRlZmVycmVkLmxlbmd0aDsgaSsrKSB7XG5cdFx0dmFyIFtjaHVua0lkcywgZm4sIHByaW9yaXR5XSA9IGRlZmVycmVkW2ldO1xuXHRcdHZhciBmdWxmaWxsZWQgPSB0cnVlO1xuXHRcdGZvciAodmFyIGogPSAwOyBqIDwgY2h1bmtJZHMubGVuZ3RoOyBqKyspIHtcblx0XHRcdGlmICgocHJpb3JpdHkgJiAxID09PSAwIHx8IG5vdEZ1bGZpbGxlZCA+PSBwcmlvcml0eSkgJiYgT2JqZWN0LmtleXMoX193ZWJwYWNrX3JlcXVpcmVfXy5PKS5ldmVyeSgoa2V5KSA9PiAoX193ZWJwYWNrX3JlcXVpcmVfXy5PW2tleV0oY2h1bmtJZHNbal0pKSkpIHtcblx0XHRcdFx0Y2h1bmtJZHMuc3BsaWNlKGotLSwgMSk7XG5cdFx0XHR9IGVsc2Uge1xuXHRcdFx0XHRmdWxmaWxsZWQgPSBmYWxzZTtcblx0XHRcdFx0aWYocHJpb3JpdHkgPCBub3RGdWxmaWxsZWQpIG5vdEZ1bGZpbGxlZCA9IHByaW9yaXR5O1xuXHRcdFx0fVxuXHRcdH1cblx0XHRpZihmdWxmaWxsZWQpIHtcblx0XHRcdGRlZmVycmVkLnNwbGljZShpLS0sIDEpXG5cdFx0XHR2YXIgciA9IGZuKCk7XG5cdFx0XHRpZiAociAhPT0gdW5kZWZpbmVkKSByZXN1bHQgPSByO1xuXHRcdH1cblx0fVxuXHRyZXR1cm4gcmVzdWx0O1xufTsiLCIvLyBnZXREZWZhdWx0RXhwb3J0IGZ1bmN0aW9uIGZvciBjb21wYXRpYmlsaXR5IHdpdGggbm9uLWhhcm1vbnkgbW9kdWxlc1xuX193ZWJwYWNrX3JlcXVpcmVfXy5uID0gKG1vZHVsZSkgPT4ge1xuXHR2YXIgZ2V0dGVyID0gbW9kdWxlICYmIG1vZHVsZS5fX2VzTW9kdWxlID9cblx0XHQoKSA9PiAobW9kdWxlWydkZWZhdWx0J10pIDpcblx0XHQoKSA9PiAobW9kdWxlKTtcblx0X193ZWJwYWNrX3JlcXVpcmVfXy5kKGdldHRlciwgeyBhOiBnZXR0ZXIgfSk7XG5cdHJldHVybiBnZXR0ZXI7XG59OyIsIi8vIGRlZmluZSBnZXR0ZXIgZnVuY3Rpb25zIGZvciBoYXJtb255IGV4cG9ydHNcbl9fd2VicGFja19yZXF1aXJlX18uZCA9IChleHBvcnRzLCBkZWZpbml0aW9uKSA9PiB7XG5cdGZvcih2YXIga2V5IGluIGRlZmluaXRpb24pIHtcblx0XHRpZihfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZGVmaW5pdGlvbiwga2V5KSAmJiAhX193ZWJwYWNrX3JlcXVpcmVfXy5vKGV4cG9ydHMsIGtleSkpIHtcblx0XHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBrZXksIHsgZW51bWVyYWJsZTogdHJ1ZSwgZ2V0OiBkZWZpbml0aW9uW2tleV0gfSk7XG5cdFx0fVxuXHR9XG59OyIsIl9fd2VicGFja19yZXF1aXJlX18uZiA9IHt9O1xuLy8gVGhpcyBmaWxlIGNvbnRhaW5zIG9ubHkgdGhlIGVudHJ5IGNodW5rLlxuLy8gVGhlIGNodW5rIGxvYWRpbmcgZnVuY3Rpb24gZm9yIGFkZGl0aW9uYWwgY2h1bmtzXG5fX3dlYnBhY2tfcmVxdWlyZV9fLmUgPSAoY2h1bmtJZCkgPT4ge1xuXHRyZXR1cm4gUHJvbWlzZS5hbGwoT2JqZWN0LmtleXMoX193ZWJwYWNrX3JlcXVpcmVfXy5mKS5yZWR1Y2UoKHByb21pc2VzLCBrZXkpID0+IHtcblx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLmZba2V5XShjaHVua0lkLCBwcm9taXNlcyk7XG5cdFx0cmV0dXJuIHByb21pc2VzO1xuXHR9LCBbXSkpO1xufTsiLCIvLyBUaGlzIGZ1bmN0aW9uIGFsbG93IHRvIHJlZmVyZW5jZSBhc3luYyBjaHVua3Ncbl9fd2VicGFja19yZXF1aXJlX18udSA9IChjaHVua0lkKSA9PiB7XG5cdC8vIHJldHVybiB1cmwgZm9yIGZpbGVuYW1lcyBiYXNlZCBvbiB0ZW1wbGF0ZVxuXHRyZXR1cm4gXCJcIiArIGNodW5rSWQgKyBcIi5qc1wiO1xufTsiLCIvLyBUaGlzIGZ1bmN0aW9uIGFsbG93IHRvIHJlZmVyZW5jZSBhbGwgY2h1bmtzXG5fX3dlYnBhY2tfcmVxdWlyZV9fLm1pbmlDc3NGID0gKGNodW5rSWQpID0+IHtcblx0Ly8gcmV0dXJuIHVybCBmb3IgZmlsZW5hbWVzIGJhc2VkIG9uIHRlbXBsYXRlXG5cdHJldHVybiBcIlwiICsgY2h1bmtJZCArIFwiLmNzc1wiO1xufTsiLCJfX3dlYnBhY2tfcmVxdWlyZV9fLmcgPSAoZnVuY3Rpb24oKSB7XG5cdGlmICh0eXBlb2YgZ2xvYmFsVGhpcyA9PT0gJ29iamVjdCcpIHJldHVybiBnbG9iYWxUaGlzO1xuXHR0cnkge1xuXHRcdHJldHVybiB0aGlzIHx8IG5ldyBGdW5jdGlvbigncmV0dXJuIHRoaXMnKSgpO1xuXHR9IGNhdGNoIChlKSB7XG5cdFx0aWYgKHR5cGVvZiB3aW5kb3cgPT09ICdvYmplY3QnKSByZXR1cm4gd2luZG93O1xuXHR9XG59KSgpOyIsIl9fd2VicGFja19yZXF1aXJlX18ubyA9IChvYmosIHByb3ApID0+IChPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwob2JqLCBwcm9wKSkiLCJ2YXIgaW5Qcm9ncmVzcyA9IHt9O1xudmFyIGRhdGFXZWJwYWNrUHJlZml4ID0gXCJpc3BvbnNvcjpcIjtcbi8vIGxvYWRTY3JpcHQgZnVuY3Rpb24gdG8gbG9hZCBhIHNjcmlwdCB2aWEgc2NyaXB0IHRhZ1xuX193ZWJwYWNrX3JlcXVpcmVfXy5sID0gKHVybCwgZG9uZSwga2V5LCBjaHVua0lkKSA9PiB7XG5cdGlmKGluUHJvZ3Jlc3NbdXJsXSkgeyBpblByb2dyZXNzW3VybF0ucHVzaChkb25lKTsgcmV0dXJuOyB9XG5cdHZhciBzY3JpcHQsIG5lZWRBdHRhY2g7XG5cdGlmKGtleSAhPT0gdW5kZWZpbmVkKSB7XG5cdFx0dmFyIHNjcmlwdHMgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5VGFnTmFtZShcInNjcmlwdFwiKTtcblx0XHRmb3IodmFyIGkgPSAwOyBpIDwgc2NyaXB0cy5sZW5ndGg7IGkrKykge1xuXHRcdFx0dmFyIHMgPSBzY3JpcHRzW2ldO1xuXHRcdFx0aWYocy5nZXRBdHRyaWJ1dGUoXCJzcmNcIikgPT0gdXJsIHx8IHMuZ2V0QXR0cmlidXRlKFwiZGF0YS13ZWJwYWNrXCIpID09IGRhdGFXZWJwYWNrUHJlZml4ICsga2V5KSB7IHNjcmlwdCA9IHM7IGJyZWFrOyB9XG5cdFx0fVxuXHR9XG5cdGlmKCFzY3JpcHQpIHtcblx0XHRuZWVkQXR0YWNoID0gdHJ1ZTtcblx0XHRzY3JpcHQgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdzY3JpcHQnKTtcblxuXHRcdHNjcmlwdC5jaGFyc2V0ID0gJ3V0Zi04Jztcblx0XHRzY3JpcHQudGltZW91dCA9IDEyMDtcblx0XHRpZiAoX193ZWJwYWNrX3JlcXVpcmVfXy5uYykge1xuXHRcdFx0c2NyaXB0LnNldEF0dHJpYnV0ZShcIm5vbmNlXCIsIF9fd2VicGFja19yZXF1aXJlX18ubmMpO1xuXHRcdH1cblx0XHRzY3JpcHQuc2V0QXR0cmlidXRlKFwiZGF0YS13ZWJwYWNrXCIsIGRhdGFXZWJwYWNrUHJlZml4ICsga2V5KTtcblx0XHRzY3JpcHQuc3JjID0gdXJsO1xuXHR9XG5cdGluUHJvZ3Jlc3NbdXJsXSA9IFtkb25lXTtcblx0dmFyIG9uU2NyaXB0Q29tcGxldGUgPSAocHJldiwgZXZlbnQpID0+IHtcblx0XHQvLyBhdm9pZCBtZW0gbGVha3MgaW4gSUUuXG5cdFx0c2NyaXB0Lm9uZXJyb3IgPSBzY3JpcHQub25sb2FkID0gbnVsbDtcblx0XHRjbGVhclRpbWVvdXQodGltZW91dCk7XG5cdFx0dmFyIGRvbmVGbnMgPSBpblByb2dyZXNzW3VybF07XG5cdFx0ZGVsZXRlIGluUHJvZ3Jlc3NbdXJsXTtcblx0XHRzY3JpcHQucGFyZW50Tm9kZSAmJiBzY3JpcHQucGFyZW50Tm9kZS5yZW1vdmVDaGlsZChzY3JpcHQpO1xuXHRcdGRvbmVGbnMgJiYgZG9uZUZucy5mb3JFYWNoKChmbikgPT4gKGZuKGV2ZW50KSkpO1xuXHRcdGlmKHByZXYpIHJldHVybiBwcmV2KGV2ZW50KTtcblx0fVxuXHR2YXIgdGltZW91dCA9IHNldFRpbWVvdXQob25TY3JpcHRDb21wbGV0ZS5iaW5kKG51bGwsIHVuZGVmaW5lZCwgeyB0eXBlOiAndGltZW91dCcsIHRhcmdldDogc2NyaXB0IH0pLCAxMjAwMDApO1xuXHRzY3JpcHQub25lcnJvciA9IG9uU2NyaXB0Q29tcGxldGUuYmluZChudWxsLCBzY3JpcHQub25lcnJvcik7XG5cdHNjcmlwdC5vbmxvYWQgPSBvblNjcmlwdENvbXBsZXRlLmJpbmQobnVsbCwgc2NyaXB0Lm9ubG9hZCk7XG5cdG5lZWRBdHRhY2ggJiYgZG9jdW1lbnQuaGVhZC5hcHBlbmRDaGlsZChzY3JpcHQpO1xufTsiLCIvLyBkZWZpbmUgX19lc01vZHVsZSBvbiBleHBvcnRzXG5fX3dlYnBhY2tfcmVxdWlyZV9fLnIgPSAoZXhwb3J0cykgPT4ge1xuXHRpZih0eXBlb2YgU3ltYm9sICE9PSAndW5kZWZpbmVkJyAmJiBTeW1ib2wudG9TdHJpbmdUYWcpIHtcblx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgU3ltYm9sLnRvU3RyaW5nVGFnLCB7IHZhbHVlOiAnTW9kdWxlJyB9KTtcblx0fVxuXHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgJ19fZXNNb2R1bGUnLCB7IHZhbHVlOiB0cnVlIH0pO1xufTsiLCJfX3dlYnBhY2tfcmVxdWlyZV9fLnAgPSBcIi9idWlsZC9cIjsiLCJ2YXIgY3JlYXRlU3R5bGVzaGVldCA9IChjaHVua0lkLCBmdWxsaHJlZiwgcmVzb2x2ZSwgcmVqZWN0KSA9PiB7XG5cdHZhciBsaW5rVGFnID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudChcImxpbmtcIik7XG5cblx0bGlua1RhZy5yZWwgPSBcInN0eWxlc2hlZXRcIjtcblx0bGlua1RhZy50eXBlID0gXCJ0ZXh0L2Nzc1wiO1xuXHR2YXIgb25MaW5rQ29tcGxldGUgPSAoZXZlbnQpID0+IHtcblx0XHQvLyBhdm9pZCBtZW0gbGVha3MuXG5cdFx0bGlua1RhZy5vbmVycm9yID0gbGlua1RhZy5vbmxvYWQgPSBudWxsO1xuXHRcdGlmIChldmVudC50eXBlID09PSAnbG9hZCcpIHtcblx0XHRcdHJlc29sdmUoKTtcblx0XHR9IGVsc2Uge1xuXHRcdFx0dmFyIGVycm9yVHlwZSA9IGV2ZW50ICYmIChldmVudC50eXBlID09PSAnbG9hZCcgPyAnbWlzc2luZycgOiBldmVudC50eXBlKTtcblx0XHRcdHZhciByZWFsSHJlZiA9IGV2ZW50ICYmIGV2ZW50LnRhcmdldCAmJiBldmVudC50YXJnZXQuaHJlZiB8fCBmdWxsaHJlZjtcblx0XHRcdHZhciBlcnIgPSBuZXcgRXJyb3IoXCJMb2FkaW5nIENTUyBjaHVuayBcIiArIGNodW5rSWQgKyBcIiBmYWlsZWQuXFxuKFwiICsgcmVhbEhyZWYgKyBcIilcIik7XG5cdFx0XHRlcnIuY29kZSA9IFwiQ1NTX0NIVU5LX0xPQURfRkFJTEVEXCI7XG5cdFx0XHRlcnIudHlwZSA9IGVycm9yVHlwZTtcblx0XHRcdGVyci5yZXF1ZXN0ID0gcmVhbEhyZWY7XG5cdFx0XHRsaW5rVGFnLnBhcmVudE5vZGUucmVtb3ZlQ2hpbGQobGlua1RhZylcblx0XHRcdHJlamVjdChlcnIpO1xuXHRcdH1cblx0fVxuXHRsaW5rVGFnLm9uZXJyb3IgPSBsaW5rVGFnLm9ubG9hZCA9IG9uTGlua0NvbXBsZXRlO1xuXHRsaW5rVGFnLmhyZWYgPSBmdWxsaHJlZjtcblxuXHRkb2N1bWVudC5oZWFkLmFwcGVuZENoaWxkKGxpbmtUYWcpO1xuXHRyZXR1cm4gbGlua1RhZztcbn07XG52YXIgZmluZFN0eWxlc2hlZXQgPSAoaHJlZiwgZnVsbGhyZWYpID0+IHtcblx0dmFyIGV4aXN0aW5nTGlua1RhZ3MgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5VGFnTmFtZShcImxpbmtcIik7XG5cdGZvcih2YXIgaSA9IDA7IGkgPCBleGlzdGluZ0xpbmtUYWdzLmxlbmd0aDsgaSsrKSB7XG5cdFx0dmFyIHRhZyA9IGV4aXN0aW5nTGlua1RhZ3NbaV07XG5cdFx0dmFyIGRhdGFIcmVmID0gdGFnLmdldEF0dHJpYnV0ZShcImRhdGEtaHJlZlwiKSB8fCB0YWcuZ2V0QXR0cmlidXRlKFwiaHJlZlwiKTtcblx0XHRpZih0YWcucmVsID09PSBcInN0eWxlc2hlZXRcIiAmJiAoZGF0YUhyZWYgPT09IGhyZWYgfHwgZGF0YUhyZWYgPT09IGZ1bGxocmVmKSkgcmV0dXJuIHRhZztcblx0fVxuXHR2YXIgZXhpc3RpbmdTdHlsZVRhZ3MgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5VGFnTmFtZShcInN0eWxlXCIpO1xuXHRmb3IodmFyIGkgPSAwOyBpIDwgZXhpc3RpbmdTdHlsZVRhZ3MubGVuZ3RoOyBpKyspIHtcblx0XHR2YXIgdGFnID0gZXhpc3RpbmdTdHlsZVRhZ3NbaV07XG5cdFx0dmFyIGRhdGFIcmVmID0gdGFnLmdldEF0dHJpYnV0ZShcImRhdGEtaHJlZlwiKTtcblx0XHRpZihkYXRhSHJlZiA9PT0gaHJlZiB8fCBkYXRhSHJlZiA9PT0gZnVsbGhyZWYpIHJldHVybiB0YWc7XG5cdH1cbn07XG52YXIgbG9hZFN0eWxlc2hlZXQgPSAoY2h1bmtJZCkgPT4ge1xuXHRyZXR1cm4gbmV3IFByb21pc2UoKHJlc29sdmUsIHJlamVjdCkgPT4ge1xuXHRcdHZhciBocmVmID0gX193ZWJwYWNrX3JlcXVpcmVfXy5taW5pQ3NzRihjaHVua0lkKTtcblx0XHR2YXIgZnVsbGhyZWYgPSBfX3dlYnBhY2tfcmVxdWlyZV9fLnAgKyBocmVmO1xuXHRcdGlmKGZpbmRTdHlsZXNoZWV0KGhyZWYsIGZ1bGxocmVmKSkgcmV0dXJuIHJlc29sdmUoKTtcblx0XHRjcmVhdGVTdHlsZXNoZWV0KGNodW5rSWQsIGZ1bGxocmVmLCByZXNvbHZlLCByZWplY3QpO1xuXHR9KTtcbn1cbi8vIG9iamVjdCB0byBzdG9yZSBsb2FkZWQgQ1NTIGNodW5rc1xudmFyIGluc3RhbGxlZENzc0NodW5rcyA9IHtcblx0XCJiYXNlXCI6IDBcbn07XG5cbl9fd2VicGFja19yZXF1aXJlX18uZi5taW5pQ3NzID0gKGNodW5rSWQsIHByb21pc2VzKSA9PiB7XG5cdHZhciBjc3NDaHVua3MgPSB7XCJhc3NldF9jc3NfbmF2YmFyX2Nzc1wiOjF9O1xuXHRpZihpbnN0YWxsZWRDc3NDaHVua3NbY2h1bmtJZF0pIHByb21pc2VzLnB1c2goaW5zdGFsbGVkQ3NzQ2h1bmtzW2NodW5rSWRdKTtcblx0ZWxzZSBpZihpbnN0YWxsZWRDc3NDaHVua3NbY2h1bmtJZF0gIT09IDAgJiYgY3NzQ2h1bmtzW2NodW5rSWRdKSB7XG5cdFx0cHJvbWlzZXMucHVzaChpbnN0YWxsZWRDc3NDaHVua3NbY2h1bmtJZF0gPSBsb2FkU3R5bGVzaGVldChjaHVua0lkKS50aGVuKCgpID0+IHtcblx0XHRcdGluc3RhbGxlZENzc0NodW5rc1tjaHVua0lkXSA9IDA7XG5cdFx0fSwgKGUpID0+IHtcblx0XHRcdGRlbGV0ZSBpbnN0YWxsZWRDc3NDaHVua3NbY2h1bmtJZF07XG5cdFx0XHR0aHJvdyBlO1xuXHRcdH0pKTtcblx0fVxufTtcblxuLy8gbm8gaG1yIiwiLy8gbm8gYmFzZVVSSVxuXG4vLyBvYmplY3QgdG8gc3RvcmUgbG9hZGVkIGFuZCBsb2FkaW5nIGNodW5rc1xuLy8gdW5kZWZpbmVkID0gY2h1bmsgbm90IGxvYWRlZCwgbnVsbCA9IGNodW5rIHByZWxvYWRlZC9wcmVmZXRjaGVkXG4vLyBbcmVzb2x2ZSwgcmVqZWN0LCBQcm9taXNlXSA9IGNodW5rIGxvYWRpbmcsIDAgPSBjaHVuayBsb2FkZWRcbnZhciBpbnN0YWxsZWRDaHVua3MgPSB7XG5cdFwiYmFzZVwiOiAwLFxuXHRcInZlbmRvcnMtbm9kZV9tb2R1bGVzX3RpbnltY2Vfc2tpbnNfdWlfb3hpZGVfY29udGVudF9taW5fY3NzLW5vZGVfbW9kdWxlc190aW55bWNlX3NraW5zX3VpX294aS0yOWM3MGZcIjogMFxufTtcblxuX193ZWJwYWNrX3JlcXVpcmVfXy5mLmogPSAoY2h1bmtJZCwgcHJvbWlzZXMpID0+IHtcblx0XHQvLyBKU09OUCBjaHVuayBsb2FkaW5nIGZvciBqYXZhc2NyaXB0XG5cdFx0dmFyIGluc3RhbGxlZENodW5rRGF0YSA9IF9fd2VicGFja19yZXF1aXJlX18ubyhpbnN0YWxsZWRDaHVua3MsIGNodW5rSWQpID8gaW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdIDogdW5kZWZpbmVkO1xuXHRcdGlmKGluc3RhbGxlZENodW5rRGF0YSAhPT0gMCkgeyAvLyAwIG1lYW5zIFwiYWxyZWFkeSBpbnN0YWxsZWRcIi5cblxuXHRcdFx0Ly8gYSBQcm9taXNlIG1lYW5zIFwiY3VycmVudGx5IGxvYWRpbmdcIi5cblx0XHRcdGlmKGluc3RhbGxlZENodW5rRGF0YSkge1xuXHRcdFx0XHRwcm9taXNlcy5wdXNoKGluc3RhbGxlZENodW5rRGF0YVsyXSk7XG5cdFx0XHR9IGVsc2Uge1xuXHRcdFx0XHRpZihcInZlbmRvcnMtbm9kZV9tb2R1bGVzX3RpbnltY2Vfc2tpbnNfdWlfb3hpZGVfY29udGVudF9taW5fY3NzLW5vZGVfbW9kdWxlc190aW55bWNlX3NraW5zX3VpX294aS0yOWM3MGZcIiAhPSBjaHVua0lkKSB7XG5cdFx0XHRcdFx0Ly8gc2V0dXAgUHJvbWlzZSBpbiBjaHVuayBjYWNoZVxuXHRcdFx0XHRcdHZhciBwcm9taXNlID0gbmV3IFByb21pc2UoKHJlc29sdmUsIHJlamVjdCkgPT4gKGluc3RhbGxlZENodW5rRGF0YSA9IGluc3RhbGxlZENodW5rc1tjaHVua0lkXSA9IFtyZXNvbHZlLCByZWplY3RdKSk7XG5cdFx0XHRcdFx0cHJvbWlzZXMucHVzaChpbnN0YWxsZWRDaHVua0RhdGFbMl0gPSBwcm9taXNlKTtcblxuXHRcdFx0XHRcdC8vIHN0YXJ0IGNodW5rIGxvYWRpbmdcblx0XHRcdFx0XHR2YXIgdXJsID0gX193ZWJwYWNrX3JlcXVpcmVfXy5wICsgX193ZWJwYWNrX3JlcXVpcmVfXy51KGNodW5rSWQpO1xuXHRcdFx0XHRcdC8vIGNyZWF0ZSBlcnJvciBiZWZvcmUgc3RhY2sgdW53b3VuZCB0byBnZXQgdXNlZnVsIHN0YWNrdHJhY2UgbGF0ZXJcblx0XHRcdFx0XHR2YXIgZXJyb3IgPSBuZXcgRXJyb3IoKTtcblx0XHRcdFx0XHR2YXIgbG9hZGluZ0VuZGVkID0gKGV2ZW50KSA9PiB7XG5cdFx0XHRcdFx0XHRpZihfX3dlYnBhY2tfcmVxdWlyZV9fLm8oaW5zdGFsbGVkQ2h1bmtzLCBjaHVua0lkKSkge1xuXHRcdFx0XHRcdFx0XHRpbnN0YWxsZWRDaHVua0RhdGEgPSBpbnN0YWxsZWRDaHVua3NbY2h1bmtJZF07XG5cdFx0XHRcdFx0XHRcdGlmKGluc3RhbGxlZENodW5rRGF0YSAhPT0gMCkgaW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdID0gdW5kZWZpbmVkO1xuXHRcdFx0XHRcdFx0XHRpZihpbnN0YWxsZWRDaHVua0RhdGEpIHtcblx0XHRcdFx0XHRcdFx0XHR2YXIgZXJyb3JUeXBlID0gZXZlbnQgJiYgKGV2ZW50LnR5cGUgPT09ICdsb2FkJyA/ICdtaXNzaW5nJyA6IGV2ZW50LnR5cGUpO1xuXHRcdFx0XHRcdFx0XHRcdHZhciByZWFsU3JjID0gZXZlbnQgJiYgZXZlbnQudGFyZ2V0ICYmIGV2ZW50LnRhcmdldC5zcmM7XG5cdFx0XHRcdFx0XHRcdFx0ZXJyb3IubWVzc2FnZSA9ICdMb2FkaW5nIGNodW5rICcgKyBjaHVua0lkICsgJyBmYWlsZWQuXFxuKCcgKyBlcnJvclR5cGUgKyAnOiAnICsgcmVhbFNyYyArICcpJztcblx0XHRcdFx0XHRcdFx0XHRlcnJvci5uYW1lID0gJ0NodW5rTG9hZEVycm9yJztcblx0XHRcdFx0XHRcdFx0XHRlcnJvci50eXBlID0gZXJyb3JUeXBlO1xuXHRcdFx0XHRcdFx0XHRcdGVycm9yLnJlcXVlc3QgPSByZWFsU3JjO1xuXHRcdFx0XHRcdFx0XHRcdGluc3RhbGxlZENodW5rRGF0YVsxXShlcnJvcik7XG5cdFx0XHRcdFx0XHRcdH1cblx0XHRcdFx0XHRcdH1cblx0XHRcdFx0XHR9O1xuXHRcdFx0XHRcdF9fd2VicGFja19yZXF1aXJlX18ubCh1cmwsIGxvYWRpbmdFbmRlZCwgXCJjaHVuay1cIiArIGNodW5rSWQsIGNodW5rSWQpO1xuXHRcdFx0XHR9IGVsc2UgaW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdID0gMDtcblx0XHRcdH1cblx0XHR9XG59O1xuXG4vLyBubyBwcmVmZXRjaGluZ1xuXG4vLyBubyBwcmVsb2FkZWRcblxuLy8gbm8gSE1SXG5cbi8vIG5vIEhNUiBtYW5pZmVzdFxuXG5fX3dlYnBhY2tfcmVxdWlyZV9fLk8uaiA9IChjaHVua0lkKSA9PiAoaW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdID09PSAwKTtcblxuLy8gaW5zdGFsbCBhIEpTT05QIGNhbGxiYWNrIGZvciBjaHVuayBsb2FkaW5nXG52YXIgd2VicGFja0pzb25wQ2FsbGJhY2sgPSAocGFyZW50Q2h1bmtMb2FkaW5nRnVuY3Rpb24sIGRhdGEpID0+IHtcblx0dmFyIFtjaHVua0lkcywgbW9yZU1vZHVsZXMsIHJ1bnRpbWVdID0gZGF0YTtcblx0Ly8gYWRkIFwibW9yZU1vZHVsZXNcIiB0byB0aGUgbW9kdWxlcyBvYmplY3QsXG5cdC8vIHRoZW4gZmxhZyBhbGwgXCJjaHVua0lkc1wiIGFzIGxvYWRlZCBhbmQgZmlyZSBjYWxsYmFja1xuXHR2YXIgbW9kdWxlSWQsIGNodW5rSWQsIGkgPSAwO1xuXHRpZihjaHVua0lkcy5zb21lKChpZCkgPT4gKGluc3RhbGxlZENodW5rc1tpZF0gIT09IDApKSkge1xuXHRcdGZvcihtb2R1bGVJZCBpbiBtb3JlTW9kdWxlcykge1xuXHRcdFx0aWYoX193ZWJwYWNrX3JlcXVpcmVfXy5vKG1vcmVNb2R1bGVzLCBtb2R1bGVJZCkpIHtcblx0XHRcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5tW21vZHVsZUlkXSA9IG1vcmVNb2R1bGVzW21vZHVsZUlkXTtcblx0XHRcdH1cblx0XHR9XG5cdFx0aWYocnVudGltZSkgdmFyIHJlc3VsdCA9IHJ1bnRpbWUoX193ZWJwYWNrX3JlcXVpcmVfXyk7XG5cdH1cblx0aWYocGFyZW50Q2h1bmtMb2FkaW5nRnVuY3Rpb24pIHBhcmVudENodW5rTG9hZGluZ0Z1bmN0aW9uKGRhdGEpO1xuXHRmb3IoO2kgPCBjaHVua0lkcy5sZW5ndGg7IGkrKykge1xuXHRcdGNodW5rSWQgPSBjaHVua0lkc1tpXTtcblx0XHRpZihfX3dlYnBhY2tfcmVxdWlyZV9fLm8oaW5zdGFsbGVkQ2h1bmtzLCBjaHVua0lkKSAmJiBpbnN0YWxsZWRDaHVua3NbY2h1bmtJZF0pIHtcblx0XHRcdGluc3RhbGxlZENodW5rc1tjaHVua0lkXVswXSgpO1xuXHRcdH1cblx0XHRpbnN0YWxsZWRDaHVua3NbY2h1bmtJZF0gPSAwO1xuXHR9XG5cdHJldHVybiBfX3dlYnBhY2tfcmVxdWlyZV9fLk8ocmVzdWx0KTtcbn1cblxudmFyIGNodW5rTG9hZGluZ0dsb2JhbCA9IHNlbGZbXCJ3ZWJwYWNrQ2h1bmtpc3BvbnNvclwiXSA9IHNlbGZbXCJ3ZWJwYWNrQ2h1bmtpc3BvbnNvclwiXSB8fCBbXTtcbmNodW5rTG9hZGluZ0dsb2JhbC5mb3JFYWNoKHdlYnBhY2tKc29ucENhbGxiYWNrLmJpbmQobnVsbCwgMCkpO1xuY2h1bmtMb2FkaW5nR2xvYmFsLnB1c2ggPSB3ZWJwYWNrSnNvbnBDYWxsYmFjay5iaW5kKG51bGwsIGNodW5rTG9hZGluZ0dsb2JhbC5wdXNoLmJpbmQoY2h1bmtMb2FkaW5nR2xvYmFsKSk7IiwiIiwiLy8gc3RhcnR1cFxuLy8gTG9hZCBlbnRyeSBtb2R1bGUgYW5kIHJldHVybiBleHBvcnRzXG4vLyBUaGlzIGVudHJ5IG1vZHVsZSBkZXBlbmRzIG9uIG90aGVyIGxvYWRlZCBjaHVua3MgYW5kIGV4ZWN1dGlvbiBuZWVkIHRvIGJlIGRlbGF5ZWRcbnZhciBfX3dlYnBhY2tfZXhwb3J0c19fID0gX193ZWJwYWNrX3JlcXVpcmVfXy5PKHVuZGVmaW5lZCwgW1widmVuZG9ycy1ub2RlX21vZHVsZXNfcG9wcGVyanNfY29yZV9saWJfaW5kZXhfanMtbm9kZV9tb2R1bGVzX2NvcmUtanNfaW50ZXJuYWxzX2EtY29uc3RydWN0b3JfLWU4NmY5ZFwiLFwidmVuZG9ycy1ub2RlX21vZHVsZXNfY29yZS1qc19tb2R1bGVzX2VzX2FycmF5X2NvbmNhdF9qcy1ub2RlX21vZHVsZXNfY29yZS1qc19tb2R1bGVzX2VzX2FycmF5LTIwNDE2MlwiLFwidmVuZG9ycy1ub2RlX21vZHVsZXNfYm9vdHN0cmFwX2Rpc3RfanNfYm9vdHN0cmFwX2VzbV9taW5fanNcIixcInZlbmRvcnMtbm9kZV9tb2R1bGVzX3N5bWZvbnlfc3RpbXVsdXMtYnJpZGdlX2Rpc3RfaW5kZXhfanMtbm9kZV9tb2R1bGVzX2NvcmUtanNfbW9kdWxlc19lc19kYS05MjA5ZWRcIixcInZlbmRvcnMtbm9kZV9tb2R1bGVzX21hc29ucnktbGF5b3V0X21hc29ucnlfanMtbm9kZV9tb2R1bGVzX2pzLWNvb2tpZV9kaXN0X2pzX2Nvb2tpZV9tanNcIixcInZlbmRvcnMtbm9kZV9tb2R1bGVzX3RpbnltY2Vfc2tpbnNfdWlfb3hpZGVfY29udGVudF9taW5fY3NzLW5vZGVfbW9kdWxlc190aW55bWNlX3NraW5zX3VpX294aS0yOWM3MGZcIixcInZlbmRvcnMtbm9kZV9tb2R1bGVzX2Jvb3RzdHJhcF9kaXN0X2pzX2Jvb3RzdHJhcF9idW5kbGVfbWluX2pzLW5vZGVfbW9kdWxlc19ib290c3RyYXBfanNfZGlzdC1hNDY4OTNcIixcImFzc2V0X2ZvbnRhd2Vzb21lLXByb19qc19hbGxfbWluX2pzXCJdLCAoKSA9PiAoX193ZWJwYWNrX3JlcXVpcmVfXyhcIi4vYXNzZXQvanMvYmFzZS5qc1wiKSkpXG5fX3dlYnBhY2tfZXhwb3J0c19fID0gX193ZWJwYWNrX3JlcXVpcmVfXy5PKF9fd2VicGFja19leHBvcnRzX18pO1xuIiwiIl0sIm5hbWVzIjpbIkNvbnRyb2xsZXIiLCJfZGVmYXVsdCIsIl9Db250cm9sbGVyIiwiX2luaGVyaXRzIiwiX3N1cGVyIiwiX2NyZWF0ZVN1cGVyIiwiX2NsYXNzQ2FsbENoZWNrIiwiYXBwbHkiLCJhcmd1bWVudHMiLCJfY3JlYXRlQ2xhc3MiLCJrZXkiLCJ2YWx1ZSIsImNvbm5lY3QiLCJlbGVtZW50IiwiYWRkRXZlbnRMaXN0ZW5lciIsIl9vbkNvbm5lY3QiLCJkaXNjb25uZWN0IiwicmVtb3ZlRXZlbnRMaXN0ZW5lciIsImV2ZW50IiwiY29uc29sZSIsImxvZyIsImRldGFpbCIsImNyb3BwZXIiLCJvcHRpb25zIiwiaW1nIiwiZGVmYXVsdCIsIlRvYXN0IiwicmVxdWlyZSIsIkFycmF5IiwiZnJvbSIsImRvY3VtZW50IiwicXVlcnlTZWxlY3RvckFsbCIsImZvckVhY2giLCJ0b2FzdE5vZGUiLCJzaG93IiwicHJvdG90eXBlSG9sZGVyIiwiZ2V0RWxlbWVudEJ5SWQiLCJjb2xsZWN0aW9uUGxhY2UiLCJhZGRGb3JtVG9Db2xsZWN0aW9uIiwiZSIsInF1ZXJ5U2VsZWN0b3IiLCJ0YXJnZXQiLCJkYXRhc2V0IiwiY29sbGVjdGlvbkhvbGRlckNsYXNzIiwiaXRlbSIsImNyZWF0ZUVsZW1lbnQiLCJjbGFzc0xpc3QiLCJhZGQiLCJpdGVtcyIsInRhZyIsImFkZFRhZ0Zvcm1EZWxldGVMaW5rIiwiaW5uZXJIVE1MIiwicHJvdG90eXBlIiwicmVwbGFjZSIsImluZGV4IiwiYXBwZW5kQ2hpbGQiLCJyZW1Gb3JtQ29sbGVjdGlvbiIsInJlbW92ZUJ1dHRvbiIsInByZXZlbnREZWZhdWx0IiwicmVtb3ZlIiwiYnRuIiwiQ29va2llcyIsIk1hc29ucnkiLCJmdWxsU2NyZWVuQnV0dG9uIiwibWFzb25yeUdyaWQiLCJmdWxsU2NyZWVuSWNvbiIsIiRmdWxsU2NyZWVuSWNvbiIsInRvZ2dsZUNsYXNzIiwiJGZ1bGxTY3JJY29uQ2xhc3MiLCIkZnVsbFNjckljb25QcmVzcyIsImFzaWRlUmlnaHRQYW5lbCIsIiRhc2lkZVJpZ2h0UGFuZWwiLCJjc3MiLCJ1bmJpbmQiLCJtYXNvbnJ5TGF5b3V0IiwiJG1hc29ucnlHcmlkIiwibGVuZ3RoIiwiJG1hc29ucnkiLCJsYXlvdXQiLCIkaHRtbCIsIiQiLCIkaGlkZUFycmF5IiwiJHBhbmVsIiwiZmlsdGVyIiwiJGNvbnRlbnRCbG9jayIsIiRmdWxsU2NyZWVuQnV0dG9uIiwiJGZ1bGxTY3JlZW5NZXNzYWdlIiwiJHdpZHRoIiwid2lkdGgiLCJwYXJlbnQiLCIkbWFzb25yeUJyaWNrIiwiaXRlbVNlbGVjdG9yIiwiZ2V0IiwiY2xpY2siLCJNYXRoIiwicm91bmQiLCJyZW1vdmVDbGFzcyIsImFkZENsYXNzIiwiaGlkZSIsInRvZ2dsZSIsImFuaW1hdGUiLCJyaWdodCIsIm9uIiwidHJpZ2dlciIsImtleXByZXNzIiwia2V5Q29kZSIsIm1vZGFsIiwid2luZG93Iiwib25sb2FkIiwibW92ZVVwIiwiZGl2IiwibW92ZVVwQmxvY2siLCJzY3JvbGwiLCJzY3JvbGxZIiwiZmFkZUluIiwiZmFkZU91dCIsImh0bWwiLCJzY3JvbGxUb3AiLCJzdGFydFN0aW11bHVzQXBwIiwiYXBwIiwiY29udGV4dCJdLCJzb3VyY2VSb290IjoiIn0=