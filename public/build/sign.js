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

/***/ "./asset/js/sign.js":
/*!**************************!*\
  !*** ./asset/js/sign.js ***!
  \**************************/
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
/* harmony import */ var core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.array.slice.js */ "./node_modules/core-js/modules/es.array.slice.js");
/* harmony import */ var core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _stimulus_bridge_init__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../stimulus_bridge_init */ "./asset/stimulus_bridge_init.js");
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
/* harmony import */ var bootstrap_dist_js_bootstrap_esm_min__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! bootstrap/dist/js/bootstrap.esm.min */ "./node_modules/bootstrap/dist/js/bootstrap.esm.min.js");
/* harmony import */ var imask__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! imask */ "./node_modules/imask/esm/index.js");










__webpack_require__(/*! ../scss/sign.scss */ "./asset/scss/sign.scss");
__webpack_require__(/*! ../css/sign.css */ "./asset/css/sign.css");
__webpack_require__(/*! ../../templates/bootstrap-5.1.3/sign-in/signin.css */ "./templates/bootstrap-5.1.3/sign-in/signin.css");

/**
 * Show_me_password
 * TODO: отображение пароля не работает
 */
window.addEventListener("load", function () {
  var showMePassword = document.getElementById('vendor_security_vendorSecurity_show_me_password');
  var firstPassword = document.getElementById('vendor_security_vendorSecurity_plainPassword_first');
  var secondPassword = document.getElementById('vendor_security_vendorSecurity_plainPassword_second');
  showMePassword.addEventListener('click', function () {
    if (firstPassword.type === "text") {
      firstPassword.type = "password";
      secondPassword.type = "password";
      //showPassword.classList.remove('fa-eye-slash');
    } else {
      firstPassword.type = "text";
      secondPassword.type = "text";
      firstPassword.classList.add('mb-2');
      secondPassword.classList.add('mb-2');
      //showPassword.classList.toggle("fa-eye-slash");
    }
  });
});

/**
 * Password validation
 */
if (document.querySelectorAll('input[type="password"]').length > 1) {
  var plainValidation = function plainValidation() {
    if (passwordFirst.value !== passwordSecond.value) {
      submit.classList.add('disabled');
      passwordFirst.classList.remove('is-valid');
      passwordFirst.classList.add('is-invalid');
      passwordSecond.classList.remove('is-valid');
      passwordSecond.classList.add('is-invalid');
    } else {
      var _submit = document.querySelector('button[type="submit"]');
      passwordFirst.classList.remove('is-invalid');
      passwordFirst.classList.add('is-valid');
      passwordSecond.classList.remove('is-invalid');
      passwordSecond.classList.add('is-valid');
      _submit.classList.remove('disabled');
    }
  };
  var passwordFirst = document.getElementById('vendor_security_vendorSecurity_plainPassword_first');
  var passwordSecond = document.getElementById('vendor_security_vendorSecurity_plainPassword_second');
  var submit = document.querySelector('button[type="submit"]');
  submit.classList.add('disabled');
  passwordFirst.addEventListener('input', plainValidation);
  passwordSecond.addEventListener('input', plainValidation);
}
/**
 * Toast init
 */
Array.from(document.querySelectorAll('.toast')).forEach(function (toastNode) {
  return new bootstrap_dist_js_bootstrap_esm_min__WEBPACK_IMPORTED_MODULE_8__.Toast(toastNode).show();
});

/**
 * Bootstrap validation
 */
Array.prototype.slice.call(document.querySelectorAll('form[class="needs-validation"]')).forEach(function (form) {
  form.addEventListener('submit', function (event) {
    if (!form.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }
    form.classList.add('was-validated');
  }, false);
});

/**
 * IMask pattern
 */
if (document.querySelectorAll('input[type="tel"]').length > 0) {
  var vendorSecurity_phone = document.getElementById('vendor_registration_vendorSecurity_phone');
  var maskOptions = {
    mask: '+00000000000[0000]',
    overwrite: true
  };
  var mask = (0,imask__WEBPACK_IMPORTED_MODULE_9__["default"])(vendorSecurity_phone, maskOptions);
}

// app.post('/sendSMS', function (req, res) {
//     const {phoneNumber, recaptchaToken} = req.body;
//
//     const identityToolkit = google.identitytoolkit({
//         auth: 'GCP_API_KEY',
//         version: 'v3',
//     });
//
//     identityToolkit.relyingparty.verifyPhoneNumber({
//         code: verificationCode,
//         sessionInfo: phoneSessionId,
//     });
//
//     // verification code accepted, update phoneNumberVerified flag in database
//     // ...
// });

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

/***/ "./asset/css/sign.css":
/*!****************************!*\
  !*** ./asset/css/sign.css ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./templates/bootstrap-5.1.3/sign-in/signin.css":
/*!******************************************************!*\
  !*** ./templates/bootstrap-5.1.3/sign-in/signin.css ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./asset/scss/sign.scss":
/*!******************************!*\
  !*** ./asset/scss/sign.scss ***!
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
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
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
/******/ 			"sign": 0
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
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["vendors-node_modules_popperjs_core_lib_index_js-node_modules_core-js_internals_a-constructor_-e86f9d","vendors-node_modules_bootstrap_dist_js_bootstrap_esm_js","vendors-node_modules_bootstrap_dist_js_bootstrap_esm_min_js","vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_core-js_modules_es_da-9209ed","vendors-node_modules_imask_esm_index_js"], () => (__webpack_require__("./asset/js/sign.js")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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UEE7V0FDQTtXQUNBO1dBQ0E7V0FDQSxHQUFHO1dBQ0g7V0FDQTtXQUNBLENBQUM7Ozs7O1dDUEQ7Ozs7O1dDQUE7V0FDQTtXQUNBO1dBQ0EsdURBQXVELGlCQUFpQjtXQUN4RTtXQUNBLGdEQUFnRCxhQUFhO1dBQzdEOzs7OztXQ05BOztXQUVBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTs7V0FFQTs7V0FFQTs7V0FFQTs7V0FFQTs7V0FFQTs7V0FFQTs7V0FFQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQSxNQUFNLHFCQUFxQjtXQUMzQjtXQUNBO1dBQ0E7V0FDQTtXQUNBO1dBQ0E7V0FDQTtXQUNBOztXQUVBO1dBQ0E7V0FDQTs7Ozs7VUVoREE7VUFDQTtVQUNBO1VBQ0E7VUFDQSIsInNvdXJjZXMiOlsid2VicGFjazovL2lzcG9uc29yLyBcXC4oaiU3Q3Qpc3giLCJ3ZWJwYWNrOi8vaXNwb25zb3IvLi9hc3NldC9jb250cm9sbGVycy9jcm9wcGVyX2NvbnRyb2xsZXIuanMiLCJ3ZWJwYWNrOi8vaXNwb25zb3IvLi9hc3NldC9qcy9zaWduLmpzIiwid2VicGFjazovL2lzcG9uc29yLy4vYXNzZXQvc3RpbXVsdXNfYnJpZGdlX2luaXQuanMiLCJ3ZWJwYWNrOi8vaXNwb25zb3IvLi9hc3NldC9jc3Mvc2lnbi5jc3M/MWQzMCIsIndlYnBhY2s6Ly9pc3BvbnNvci8uL3RlbXBsYXRlcy9ib290c3RyYXAtNS4xLjMvc2lnbi1pbi9zaWduaW4uY3NzP2RiM2IiLCJ3ZWJwYWNrOi8vaXNwb25zb3IvLi9hc3NldC9zY3NzL3NpZ24uc2NzcyIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL2Jvb3RzdHJhcCIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL3J1bnRpbWUvY2h1bmsgbG9hZGVkIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9jb21wYXQgZ2V0IGRlZmF1bHQgZXhwb3J0Iiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9kZWZpbmUgcHJvcGVydHkgZ2V0dGVycyIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL3J1bnRpbWUvZ2xvYmFsIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svcnVudGltZS9oYXNPd25Qcm9wZXJ0eSBzaG9ydGhhbmQiLCJ3ZWJwYWNrOi8vaXNwb25zb3Ivd2VicGFjay9ydW50aW1lL21ha2UgbmFtZXNwYWNlIG9iamVjdCIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL3J1bnRpbWUvanNvbnAgY2h1bmsgbG9hZGluZyIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL2JlZm9yZS1zdGFydHVwIiwid2VicGFjazovL2lzcG9uc29yL3dlYnBhY2svc3RhcnR1cCIsIndlYnBhY2s6Ly9pc3BvbnNvci93ZWJwYWNrL2FmdGVyLXN0YXJ0dXAiXSwic291cmNlc0NvbnRlbnQiOlsidmFyIG1hcCA9IHtcblx0XCIuL2Nyb3BwZXJfY29udHJvbGxlci5qc1wiOiBcIi4vbm9kZV9tb2R1bGVzL0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyLmpzIS4vYXNzZXQvY29udHJvbGxlcnMvY3JvcHBlcl9jb250cm9sbGVyLmpzXCJcbn07XG5cblxuZnVuY3Rpb24gd2VicGFja0NvbnRleHQocmVxKSB7XG5cdHZhciBpZCA9IHdlYnBhY2tDb250ZXh0UmVzb2x2ZShyZXEpO1xuXHRyZXR1cm4gX193ZWJwYWNrX3JlcXVpcmVfXyhpZCk7XG59XG5mdW5jdGlvbiB3ZWJwYWNrQ29udGV4dFJlc29sdmUocmVxKSB7XG5cdGlmKCFfX3dlYnBhY2tfcmVxdWlyZV9fLm8obWFwLCByZXEpKSB7XG5cdFx0dmFyIGUgPSBuZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiICsgcmVxICsgXCInXCIpO1xuXHRcdGUuY29kZSA9ICdNT0RVTEVfTk9UX0ZPVU5EJztcblx0XHR0aHJvdyBlO1xuXHR9XG5cdHJldHVybiBtYXBbcmVxXTtcbn1cbndlYnBhY2tDb250ZXh0LmtleXMgPSBmdW5jdGlvbiB3ZWJwYWNrQ29udGV4dEtleXMoKSB7XG5cdHJldHVybiBPYmplY3Qua2V5cyhtYXApO1xufTtcbndlYnBhY2tDb250ZXh0LnJlc29sdmUgPSB3ZWJwYWNrQ29udGV4dFJlc29sdmU7XG5tb2R1bGUuZXhwb3J0cyA9IHdlYnBhY2tDb250ZXh0O1xud2VicGFja0NvbnRleHQuaWQgPSBcIi4vYXNzZXQvY29udHJvbGxlcnMgc3luYyByZWN1cnNpdmUgLi9ub2RlX21vZHVsZXMvQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIuanMhIFxcXFwuKGolN0N0KXN4PyRcIjsiLCJpbXBvcnQgeyBDb250cm9sbGVyIH0gZnJvbSAnc3RpbXVsdXMnO1xuXG5leHBvcnQgZGVmYXVsdCBjbGFzcyBleHRlbmRzIENvbnRyb2xsZXIge1xuICAgIGNvbm5lY3QoKSB7XG4gICAgICAgIHRoaXMuZWxlbWVudC5hZGRFdmVudExpc3RlbmVyKCdjcm9wcGVyanM6Y29ubmVjdCcsIHRoaXMuX29uQ29ubmVjdCk7XG4gICAgfVxuXG4gICAgZGlzY29ubmVjdCgpIHtcbiAgICAgICAgLy8gWW91IHNob3VsZCBhbHdheXMgcmVtb3ZlIGxpc3RlbmVycyB3aGVuIHRoZSBjb250cm9sbGVyIGlzIGRpc2Nvbm5lY3RlZCB0byBhdm9pZCBzaWRlIGVmZmVjdHNcbiAgICAgICAgdGhpcy5lbGVtZW50LnJlbW92ZUV2ZW50TGlzdGVuZXIoJ2Nyb3BwZXJqczpjb25uZWN0JywgdGhpcy5fb25Db25uZWN0KTtcbiAgICB9XG5cbiAgICBfb25Db25uZWN0KGV2ZW50KSB7XG4gICAgICAgIGNvbnNvbGUubG9nKGV2ZW50LmRldGFpbC5jcm9wcGVyKTtcbiAgICAgICAgY29uc29sZS5sb2coZXZlbnQuZGV0YWlsLm9wdGlvbnMpO1xuICAgICAgICBjb25zb2xlLmxvZyhldmVudC5kZXRhaWwuaW1nKTtcblxuICAgICAgICBldmVudC5kZXRhaWwuaW1nLmFkZEV2ZW50TGlzdGVuZXIoJ2Nyb3BlbmQnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBjb25zb2xlLmxvZyhcImVuZGVkIGNyb2pvcGFtbmRranduYmRcIilcbiAgICAgICAgfSk7XG4gICAgfVxufVxuIiwiaW1wb3J0ICcuLi9zdGltdWx1c19icmlkZ2VfaW5pdCdcbmltcG9ydCAnYm9vdHN0cmFwJ1xuaW1wb3J0IHsgVG9hc3QgfSBmcm9tICdib290c3RyYXAvZGlzdC9qcy9ib290c3RyYXAuZXNtLm1pbidcbmltcG9ydCBJTWFzayBmcm9tICdpbWFzayc7XG5cbnJlcXVpcmUoJy4uL3Njc3Mvc2lnbi5zY3NzJylcbnJlcXVpcmUoJy4uL2Nzcy9zaWduLmNzcycpXG5yZXF1aXJlKCcuLi8uLi90ZW1wbGF0ZXMvYm9vdHN0cmFwLTUuMS4zL3NpZ24taW4vc2lnbmluLmNzcycpXG5cbi8qKlxuICogU2hvd19tZV9wYXNzd29yZFxuICogVE9ETzog0L7RgtC+0LHRgNCw0LbQtdC90LjQtSDQv9Cw0YDQvtC70Y8g0L3QtSDRgNCw0LHQvtGC0LDQtdGCXG4gKi9cbndpbmRvdy5hZGRFdmVudExpc3RlbmVyKFwibG9hZFwiLCBmdW5jdGlvbigpIHtcbiAgICBsZXQgc2hvd01lUGFzc3dvcmQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgndmVuZG9yX3NlY3VyaXR5X3ZlbmRvclNlY3VyaXR5X3Nob3dfbWVfcGFzc3dvcmQnKTtcbiAgICBsZXQgZmlyc3RQYXNzd29yZCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCd2ZW5kb3Jfc2VjdXJpdHlfdmVuZG9yU2VjdXJpdHlfcGxhaW5QYXNzd29yZF9maXJzdCcpO1xuICAgIGxldCBzZWNvbmRQYXNzd29yZCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCd2ZW5kb3Jfc2VjdXJpdHlfdmVuZG9yU2VjdXJpdHlfcGxhaW5QYXNzd29yZF9zZWNvbmQnKTtcblxuICAgIHNob3dNZVBhc3N3b3JkLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4ge1xuICAgICAgICBpZiAoIGZpcnN0UGFzc3dvcmQudHlwZSA9PT0gXCJ0ZXh0XCIgKSB7XG4gICAgICAgICAgICBmaXJzdFBhc3N3b3JkLnR5cGUgPSBcInBhc3N3b3JkXCJcbiAgICAgICAgICAgIHNlY29uZFBhc3N3b3JkLnR5cGUgPSBcInBhc3N3b3JkXCJcbiAgICAgICAgICAgIC8vc2hvd1Bhc3N3b3JkLmNsYXNzTGlzdC5yZW1vdmUoJ2ZhLWV5ZS1zbGFzaCcpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgZmlyc3RQYXNzd29yZC50eXBlID0gXCJ0ZXh0XCJcbiAgICAgICAgICAgIHNlY29uZFBhc3N3b3JkLnR5cGUgPSBcInRleHRcIlxuICAgICAgICAgICAgZmlyc3RQYXNzd29yZC5jbGFzc0xpc3QuYWRkKCdtYi0yJylcbiAgICAgICAgICAgIHNlY29uZFBhc3N3b3JkLmNsYXNzTGlzdC5hZGQoJ21iLTInKVxuICAgICAgICAgICAgLy9zaG93UGFzc3dvcmQuY2xhc3NMaXN0LnRvZ2dsZShcImZhLWV5ZS1zbGFzaFwiKTtcbiAgICAgICAgfVxuICAgIH0pXG59KVxuXG4vKipcbiAqIFBhc3N3b3JkIHZhbGlkYXRpb25cbiAqL1xuaWYgKGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJ2lucHV0W3R5cGU9XCJwYXNzd29yZFwiXScpLmxlbmd0aCA+IDEpIHtcblxuICAgIGxldCBwYXNzd29yZEZpcnN0ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3ZlbmRvcl9zZWN1cml0eV92ZW5kb3JTZWN1cml0eV9wbGFpblBhc3N3b3JkX2ZpcnN0JylcbiAgICBsZXQgcGFzc3dvcmRTZWNvbmQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgndmVuZG9yX3NlY3VyaXR5X3ZlbmRvclNlY3VyaXR5X3BsYWluUGFzc3dvcmRfc2Vjb25kJylcblxuICAgIGxldCBzdWJtaXQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdidXR0b25bdHlwZT1cInN1Ym1pdFwiXScpXG5cbiAgICBzdWJtaXQuY2xhc3NMaXN0LmFkZCgnZGlzYWJsZWQnKVxuXG4gICAgcGFzc3dvcmRGaXJzdC5hZGRFdmVudExpc3RlbmVyKCdpbnB1dCcsIHBsYWluVmFsaWRhdGlvbilcbiAgICBwYXNzd29yZFNlY29uZC5hZGRFdmVudExpc3RlbmVyKCdpbnB1dCcsIHBsYWluVmFsaWRhdGlvbilcblxuICAgIGZ1bmN0aW9uIHBsYWluVmFsaWRhdGlvbigpe1xuICAgICAgICBpZiAocGFzc3dvcmRGaXJzdC52YWx1ZSAhPT0gcGFzc3dvcmRTZWNvbmQudmFsdWUpIHtcbiAgICAgICAgICAgIHN1Ym1pdC5jbGFzc0xpc3QuYWRkKCdkaXNhYmxlZCcpXG4gICAgICAgICAgICBwYXNzd29yZEZpcnN0LmNsYXNzTGlzdC5yZW1vdmUoJ2lzLXZhbGlkJylcbiAgICAgICAgICAgIHBhc3N3b3JkRmlyc3QuY2xhc3NMaXN0LmFkZCgnaXMtaW52YWxpZCcpXG4gICAgICAgICAgICBwYXNzd29yZFNlY29uZC5jbGFzc0xpc3QucmVtb3ZlKCdpcy12YWxpZCcpXG4gICAgICAgICAgICBwYXNzd29yZFNlY29uZC5jbGFzc0xpc3QuYWRkKCdpcy1pbnZhbGlkJylcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIGxldCBzdWJtaXQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdidXR0b25bdHlwZT1cInN1Ym1pdFwiXScpXG4gICAgICAgICAgICBwYXNzd29yZEZpcnN0LmNsYXNzTGlzdC5yZW1vdmUoJ2lzLWludmFsaWQnKVxuICAgICAgICAgICAgcGFzc3dvcmRGaXJzdC5jbGFzc0xpc3QuYWRkKCdpcy12YWxpZCcpXG4gICAgICAgICAgICBwYXNzd29yZFNlY29uZC5jbGFzc0xpc3QucmVtb3ZlKCdpcy1pbnZhbGlkJylcbiAgICAgICAgICAgIHBhc3N3b3JkU2Vjb25kLmNsYXNzTGlzdC5hZGQoJ2lzLXZhbGlkJylcbiAgICAgICAgICAgIHN1Ym1pdC5jbGFzc0xpc3QucmVtb3ZlKCdkaXNhYmxlZCcpXG4gICAgICAgIH1cbiAgICB9XG59XG4vKipcbiAqIFRvYXN0IGluaXRcbiAqL1xuQXJyYXkuZnJvbShkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcudG9hc3QnKSlcbiAgICAuZm9yRWFjaCh0b2FzdE5vZGUgPT4gbmV3IFRvYXN0KHRvYXN0Tm9kZSkuc2hvdygpKTtcblxuLyoqXG4gKiBCb290c3RyYXAgdmFsaWRhdGlvblxuICovXG5BcnJheS5wcm90b3R5cGUuc2xpY2UuY2FsbChkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCdmb3JtW2NsYXNzPVwibmVlZHMtdmFsaWRhdGlvblwiXScpKVxuICAgIC5mb3JFYWNoKGZ1bmN0aW9uIChmb3JtKSB7XG4gICAgICAgIGZvcm0uYWRkRXZlbnRMaXN0ZW5lcignc3VibWl0JywgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICAgICAgICBpZiAoIWZvcm0uY2hlY2tWYWxpZGl0eSgpKSB7XG4gICAgICAgICAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKVxuICAgICAgICAgICAgICAgIGV2ZW50LnN0b3BQcm9wYWdhdGlvbigpXG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIGZvcm0uY2xhc3NMaXN0LmFkZCgnd2FzLXZhbGlkYXRlZCcpXG4gICAgICAgIH0sIGZhbHNlKVxuICAgIH0pXG5cbi8qKlxuICogSU1hc2sgcGF0dGVyblxuICovXG5pZiAoZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnaW5wdXRbdHlwZT1cInRlbFwiXScpLmxlbmd0aCA+IDApIHtcbiAgICBjb25zdCB2ZW5kb3JTZWN1cml0eV9waG9uZSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCd2ZW5kb3JfcmVnaXN0cmF0aW9uX3ZlbmRvclNlY3VyaXR5X3Bob25lJyk7XG4gICAgY29uc3QgbWFza09wdGlvbnMgPSB7XG4gICAgICAgIG1hc2s6ICcrMDAwMDAwMDAwMDBbMDAwMF0nLFxuICAgICAgICBvdmVyd3JpdGU6IHRydWUsXG4gICAgfTtcbiAgICBjb25zdCBtYXNrID0gSU1hc2sodmVuZG9yU2VjdXJpdHlfcGhvbmUsIG1hc2tPcHRpb25zKTtcbn1cblxuICAgIC8vIGFwcC5wb3N0KCcvc2VuZFNNUycsIGZ1bmN0aW9uIChyZXEsIHJlcykge1xuICAgIC8vICAgICBjb25zdCB7cGhvbmVOdW1iZXIsIHJlY2FwdGNoYVRva2VufSA9IHJlcS5ib2R5O1xuICAgIC8vXG4gICAgLy8gICAgIGNvbnN0IGlkZW50aXR5VG9vbGtpdCA9IGdvb2dsZS5pZGVudGl0eXRvb2xraXQoe1xuICAgIC8vICAgICAgICAgYXV0aDogJ0dDUF9BUElfS0VZJyxcbiAgICAvLyAgICAgICAgIHZlcnNpb246ICd2MycsXG4gICAgLy8gICAgIH0pO1xuICAgIC8vXG4gICAgLy8gICAgIGlkZW50aXR5VG9vbGtpdC5yZWx5aW5ncGFydHkudmVyaWZ5UGhvbmVOdW1iZXIoe1xuICAgIC8vICAgICAgICAgY29kZTogdmVyaWZpY2F0aW9uQ29kZSxcbiAgICAvLyAgICAgICAgIHNlc3Npb25JbmZvOiBwaG9uZVNlc3Npb25JZCxcbiAgICAvLyAgICAgfSk7XG4gICAgLy9cbiAgICAvLyAgICAgLy8gdmVyaWZpY2F0aW9uIGNvZGUgYWNjZXB0ZWQsIHVwZGF0ZSBwaG9uZU51bWJlclZlcmlmaWVkIGZsYWcgaW4gZGF0YWJhc2VcbiAgICAvLyAgICAgLy8gLi4uXG4gICAgLy8gfSk7XG4iLCJpbXBvcnQgeyBzdGFydFN0aW11bHVzQXBwIH0gZnJvbSAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlJztcblxuLy8gUmVnaXN0ZXJzIFN0aW11bHVzIGNvbnRyb2xsZXJzIGZyb20gY29udHJvbGxlcnMuanNvbiBhbmQgaW4gdGhlIGNvbnRyb2xsZXJzLyBkaXJlY3RvcnlcbmV4cG9ydCBjb25zdCBhcHAgPSBzdGFydFN0aW11bHVzQXBwKHJlcXVpcmUuY29udGV4dChcbiAgICAnQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIhLi9jb250cm9sbGVycycsXG4gICAgdHJ1ZSxcbiAgICAvXFwuKGp8dClzeD8kL1xuKSk7XG4iLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiLCIvLyBUaGUgbW9kdWxlIGNhY2hlXG52YXIgX193ZWJwYWNrX21vZHVsZV9jYWNoZV9fID0ge307XG5cbi8vIFRoZSByZXF1aXJlIGZ1bmN0aW9uXG5mdW5jdGlvbiBfX3dlYnBhY2tfcmVxdWlyZV9fKG1vZHVsZUlkKSB7XG5cdC8vIENoZWNrIGlmIG1vZHVsZSBpcyBpbiBjYWNoZVxuXHR2YXIgY2FjaGVkTW9kdWxlID0gX193ZWJwYWNrX21vZHVsZV9jYWNoZV9fW21vZHVsZUlkXTtcblx0aWYgKGNhY2hlZE1vZHVsZSAhPT0gdW5kZWZpbmVkKSB7XG5cdFx0cmV0dXJuIGNhY2hlZE1vZHVsZS5leHBvcnRzO1xuXHR9XG5cdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG5cdHZhciBtb2R1bGUgPSBfX3dlYnBhY2tfbW9kdWxlX2NhY2hlX19bbW9kdWxlSWRdID0ge1xuXHRcdC8vIG5vIG1vZHVsZS5pZCBuZWVkZWRcblx0XHQvLyBubyBtb2R1bGUubG9hZGVkIG5lZWRlZFxuXHRcdGV4cG9ydHM6IHt9XG5cdH07XG5cblx0Ly8gRXhlY3V0ZSB0aGUgbW9kdWxlIGZ1bmN0aW9uXG5cdF9fd2VicGFja19tb2R1bGVzX19bbW9kdWxlSWRdKG1vZHVsZSwgbW9kdWxlLmV4cG9ydHMsIF9fd2VicGFja19yZXF1aXJlX18pO1xuXG5cdC8vIFJldHVybiB0aGUgZXhwb3J0cyBvZiB0aGUgbW9kdWxlXG5cdHJldHVybiBtb2R1bGUuZXhwb3J0cztcbn1cblxuLy8gZXhwb3NlIHRoZSBtb2R1bGVzIG9iamVjdCAoX193ZWJwYWNrX21vZHVsZXNfXylcbl9fd2VicGFja19yZXF1aXJlX18ubSA9IF9fd2VicGFja19tb2R1bGVzX187XG5cbiIsInZhciBkZWZlcnJlZCA9IFtdO1xuX193ZWJwYWNrX3JlcXVpcmVfXy5PID0gKHJlc3VsdCwgY2h1bmtJZHMsIGZuLCBwcmlvcml0eSkgPT4ge1xuXHRpZihjaHVua0lkcykge1xuXHRcdHByaW9yaXR5ID0gcHJpb3JpdHkgfHwgMDtcblx0XHRmb3IodmFyIGkgPSBkZWZlcnJlZC5sZW5ndGg7IGkgPiAwICYmIGRlZmVycmVkW2kgLSAxXVsyXSA+IHByaW9yaXR5OyBpLS0pIGRlZmVycmVkW2ldID0gZGVmZXJyZWRbaSAtIDFdO1xuXHRcdGRlZmVycmVkW2ldID0gW2NodW5rSWRzLCBmbiwgcHJpb3JpdHldO1xuXHRcdHJldHVybjtcblx0fVxuXHR2YXIgbm90RnVsZmlsbGVkID0gSW5maW5pdHk7XG5cdGZvciAodmFyIGkgPSAwOyBpIDwgZGVmZXJyZWQubGVuZ3RoOyBpKyspIHtcblx0XHR2YXIgW2NodW5rSWRzLCBmbiwgcHJpb3JpdHldID0gZGVmZXJyZWRbaV07XG5cdFx0dmFyIGZ1bGZpbGxlZCA9IHRydWU7XG5cdFx0Zm9yICh2YXIgaiA9IDA7IGogPCBjaHVua0lkcy5sZW5ndGg7IGorKykge1xuXHRcdFx0aWYgKChwcmlvcml0eSAmIDEgPT09IDAgfHwgbm90RnVsZmlsbGVkID49IHByaW9yaXR5KSAmJiBPYmplY3Qua2V5cyhfX3dlYnBhY2tfcmVxdWlyZV9fLk8pLmV2ZXJ5KChrZXkpID0+IChfX3dlYnBhY2tfcmVxdWlyZV9fLk9ba2V5XShjaHVua0lkc1tqXSkpKSkge1xuXHRcdFx0XHRjaHVua0lkcy5zcGxpY2Uoai0tLCAxKTtcblx0XHRcdH0gZWxzZSB7XG5cdFx0XHRcdGZ1bGZpbGxlZCA9IGZhbHNlO1xuXHRcdFx0XHRpZihwcmlvcml0eSA8IG5vdEZ1bGZpbGxlZCkgbm90RnVsZmlsbGVkID0gcHJpb3JpdHk7XG5cdFx0XHR9XG5cdFx0fVxuXHRcdGlmKGZ1bGZpbGxlZCkge1xuXHRcdFx0ZGVmZXJyZWQuc3BsaWNlKGktLSwgMSlcblx0XHRcdHZhciByID0gZm4oKTtcblx0XHRcdGlmIChyICE9PSB1bmRlZmluZWQpIHJlc3VsdCA9IHI7XG5cdFx0fVxuXHR9XG5cdHJldHVybiByZXN1bHQ7XG59OyIsIi8vIGdldERlZmF1bHRFeHBvcnQgZnVuY3Rpb24gZm9yIGNvbXBhdGliaWxpdHkgd2l0aCBub24taGFybW9ueSBtb2R1bGVzXG5fX3dlYnBhY2tfcmVxdWlyZV9fLm4gPSAobW9kdWxlKSA9PiB7XG5cdHZhciBnZXR0ZXIgPSBtb2R1bGUgJiYgbW9kdWxlLl9fZXNNb2R1bGUgP1xuXHRcdCgpID0+IChtb2R1bGVbJ2RlZmF1bHQnXSkgOlxuXHRcdCgpID0+IChtb2R1bGUpO1xuXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQoZ2V0dGVyLCB7IGE6IGdldHRlciB9KTtcblx0cmV0dXJuIGdldHRlcjtcbn07IiwiLy8gZGVmaW5lIGdldHRlciBmdW5jdGlvbnMgZm9yIGhhcm1vbnkgZXhwb3J0c1xuX193ZWJwYWNrX3JlcXVpcmVfXy5kID0gKGV4cG9ydHMsIGRlZmluaXRpb24pID0+IHtcblx0Zm9yKHZhciBrZXkgaW4gZGVmaW5pdGlvbikge1xuXHRcdGlmKF9fd2VicGFja19yZXF1aXJlX18ubyhkZWZpbml0aW9uLCBrZXkpICYmICFfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZXhwb3J0cywga2V5KSkge1xuXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIGtleSwgeyBlbnVtZXJhYmxlOiB0cnVlLCBnZXQ6IGRlZmluaXRpb25ba2V5XSB9KTtcblx0XHR9XG5cdH1cbn07IiwiX193ZWJwYWNrX3JlcXVpcmVfXy5nID0gKGZ1bmN0aW9uKCkge1xuXHRpZiAodHlwZW9mIGdsb2JhbFRoaXMgPT09ICdvYmplY3QnKSByZXR1cm4gZ2xvYmFsVGhpcztcblx0dHJ5IHtcblx0XHRyZXR1cm4gdGhpcyB8fCBuZXcgRnVuY3Rpb24oJ3JldHVybiB0aGlzJykoKTtcblx0fSBjYXRjaCAoZSkge1xuXHRcdGlmICh0eXBlb2Ygd2luZG93ID09PSAnb2JqZWN0JykgcmV0dXJuIHdpbmRvdztcblx0fVxufSkoKTsiLCJfX3dlYnBhY2tfcmVxdWlyZV9fLm8gPSAob2JqLCBwcm9wKSA9PiAoT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsKG9iaiwgcHJvcCkpIiwiLy8gZGVmaW5lIF9fZXNNb2R1bGUgb24gZXhwb3J0c1xuX193ZWJwYWNrX3JlcXVpcmVfXy5yID0gKGV4cG9ydHMpID0+IHtcblx0aWYodHlwZW9mIFN5bWJvbCAhPT0gJ3VuZGVmaW5lZCcgJiYgU3ltYm9sLnRvU3RyaW5nVGFnKSB7XG5cdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIFN5bWJvbC50b1N0cmluZ1RhZywgeyB2YWx1ZTogJ01vZHVsZScgfSk7XG5cdH1cblx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsICdfX2VzTW9kdWxlJywgeyB2YWx1ZTogdHJ1ZSB9KTtcbn07IiwiLy8gbm8gYmFzZVVSSVxuXG4vLyBvYmplY3QgdG8gc3RvcmUgbG9hZGVkIGFuZCBsb2FkaW5nIGNodW5rc1xuLy8gdW5kZWZpbmVkID0gY2h1bmsgbm90IGxvYWRlZCwgbnVsbCA9IGNodW5rIHByZWxvYWRlZC9wcmVmZXRjaGVkXG4vLyBbcmVzb2x2ZSwgcmVqZWN0LCBQcm9taXNlXSA9IGNodW5rIGxvYWRpbmcsIDAgPSBjaHVuayBsb2FkZWRcbnZhciBpbnN0YWxsZWRDaHVua3MgPSB7XG5cdFwic2lnblwiOiAwXG59O1xuXG4vLyBubyBjaHVuayBvbiBkZW1hbmQgbG9hZGluZ1xuXG4vLyBubyBwcmVmZXRjaGluZ1xuXG4vLyBubyBwcmVsb2FkZWRcblxuLy8gbm8gSE1SXG5cbi8vIG5vIEhNUiBtYW5pZmVzdFxuXG5fX3dlYnBhY2tfcmVxdWlyZV9fLk8uaiA9IChjaHVua0lkKSA9PiAoaW5zdGFsbGVkQ2h1bmtzW2NodW5rSWRdID09PSAwKTtcblxuLy8gaW5zdGFsbCBhIEpTT05QIGNhbGxiYWNrIGZvciBjaHVuayBsb2FkaW5nXG52YXIgd2VicGFja0pzb25wQ2FsbGJhY2sgPSAocGFyZW50Q2h1bmtMb2FkaW5nRnVuY3Rpb24sIGRhdGEpID0+IHtcblx0dmFyIFtjaHVua0lkcywgbW9yZU1vZHVsZXMsIHJ1bnRpbWVdID0gZGF0YTtcblx0Ly8gYWRkIFwibW9yZU1vZHVsZXNcIiB0byB0aGUgbW9kdWxlcyBvYmplY3QsXG5cdC8vIHRoZW4gZmxhZyBhbGwgXCJjaHVua0lkc1wiIGFzIGxvYWRlZCBhbmQgZmlyZSBjYWxsYmFja1xuXHR2YXIgbW9kdWxlSWQsIGNodW5rSWQsIGkgPSAwO1xuXHRpZihjaHVua0lkcy5zb21lKChpZCkgPT4gKGluc3RhbGxlZENodW5rc1tpZF0gIT09IDApKSkge1xuXHRcdGZvcihtb2R1bGVJZCBpbiBtb3JlTW9kdWxlcykge1xuXHRcdFx0aWYoX193ZWJwYWNrX3JlcXVpcmVfXy5vKG1vcmVNb2R1bGVzLCBtb2R1bGVJZCkpIHtcblx0XHRcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5tW21vZHVsZUlkXSA9IG1vcmVNb2R1bGVzW21vZHVsZUlkXTtcblx0XHRcdH1cblx0XHR9XG5cdFx0aWYocnVudGltZSkgdmFyIHJlc3VsdCA9IHJ1bnRpbWUoX193ZWJwYWNrX3JlcXVpcmVfXyk7XG5cdH1cblx0aWYocGFyZW50Q2h1bmtMb2FkaW5nRnVuY3Rpb24pIHBhcmVudENodW5rTG9hZGluZ0Z1bmN0aW9uKGRhdGEpO1xuXHRmb3IoO2kgPCBjaHVua0lkcy5sZW5ndGg7IGkrKykge1xuXHRcdGNodW5rSWQgPSBjaHVua0lkc1tpXTtcblx0XHRpZihfX3dlYnBhY2tfcmVxdWlyZV9fLm8oaW5zdGFsbGVkQ2h1bmtzLCBjaHVua0lkKSAmJiBpbnN0YWxsZWRDaHVua3NbY2h1bmtJZF0pIHtcblx0XHRcdGluc3RhbGxlZENodW5rc1tjaHVua0lkXVswXSgpO1xuXHRcdH1cblx0XHRpbnN0YWxsZWRDaHVua3NbY2h1bmtJZF0gPSAwO1xuXHR9XG5cdHJldHVybiBfX3dlYnBhY2tfcmVxdWlyZV9fLk8ocmVzdWx0KTtcbn1cblxudmFyIGNodW5rTG9hZGluZ0dsb2JhbCA9IHNlbGZbXCJ3ZWJwYWNrQ2h1bmtpc3BvbnNvclwiXSA9IHNlbGZbXCJ3ZWJwYWNrQ2h1bmtpc3BvbnNvclwiXSB8fCBbXTtcbmNodW5rTG9hZGluZ0dsb2JhbC5mb3JFYWNoKHdlYnBhY2tKc29ucENhbGxiYWNrLmJpbmQobnVsbCwgMCkpO1xuY2h1bmtMb2FkaW5nR2xvYmFsLnB1c2ggPSB3ZWJwYWNrSnNvbnBDYWxsYmFjay5iaW5kKG51bGwsIGNodW5rTG9hZGluZ0dsb2JhbC5wdXNoLmJpbmQoY2h1bmtMb2FkaW5nR2xvYmFsKSk7IiwiIiwiLy8gc3RhcnR1cFxuLy8gTG9hZCBlbnRyeSBtb2R1bGUgYW5kIHJldHVybiBleHBvcnRzXG4vLyBUaGlzIGVudHJ5IG1vZHVsZSBkZXBlbmRzIG9uIG90aGVyIGxvYWRlZCBjaHVua3MgYW5kIGV4ZWN1dGlvbiBuZWVkIHRvIGJlIGRlbGF5ZWRcbnZhciBfX3dlYnBhY2tfZXhwb3J0c19fID0gX193ZWJwYWNrX3JlcXVpcmVfXy5PKHVuZGVmaW5lZCwgW1widmVuZG9ycy1ub2RlX21vZHVsZXNfcG9wcGVyanNfY29yZV9saWJfaW5kZXhfanMtbm9kZV9tb2R1bGVzX2NvcmUtanNfaW50ZXJuYWxzX2EtY29uc3RydWN0b3JfLWU4NmY5ZFwiLFwidmVuZG9ycy1ub2RlX21vZHVsZXNfYm9vdHN0cmFwX2Rpc3RfanNfYm9vdHN0cmFwX2VzbV9qc1wiLFwidmVuZG9ycy1ub2RlX21vZHVsZXNfYm9vdHN0cmFwX2Rpc3RfanNfYm9vdHN0cmFwX2VzbV9taW5fanNcIixcInZlbmRvcnMtbm9kZV9tb2R1bGVzX3N5bWZvbnlfc3RpbXVsdXMtYnJpZGdlX2Rpc3RfaW5kZXhfanMtbm9kZV9tb2R1bGVzX2NvcmUtanNfbW9kdWxlc19lc19kYS05MjA5ZWRcIixcInZlbmRvcnMtbm9kZV9tb2R1bGVzX2ltYXNrX2VzbV9pbmRleF9qc1wiXSwgKCkgPT4gKF9fd2VicGFja19yZXF1aXJlX18oXCIuL2Fzc2V0L2pzL3NpZ24uanNcIikpKVxuX193ZWJwYWNrX2V4cG9ydHNfXyA9IF9fd2VicGFja19yZXF1aXJlX18uTyhfX3dlYnBhY2tfZXhwb3J0c19fKTtcbiIsIiJdLCJuYW1lcyI6WyJDb250cm9sbGVyIiwiX2RlZmF1bHQiLCJfQ29udHJvbGxlciIsIl9pbmhlcml0cyIsIl9zdXBlciIsIl9jcmVhdGVTdXBlciIsIl9jbGFzc0NhbGxDaGVjayIsImFwcGx5IiwiYXJndW1lbnRzIiwiX2NyZWF0ZUNsYXNzIiwia2V5IiwidmFsdWUiLCJjb25uZWN0IiwiZWxlbWVudCIsImFkZEV2ZW50TGlzdGVuZXIiLCJfb25Db25uZWN0IiwiZGlzY29ubmVjdCIsInJlbW92ZUV2ZW50TGlzdGVuZXIiLCJldmVudCIsImNvbnNvbGUiLCJsb2ciLCJkZXRhaWwiLCJjcm9wcGVyIiwib3B0aW9ucyIsImltZyIsImRlZmF1bHQiLCJUb2FzdCIsIklNYXNrIiwicmVxdWlyZSIsIndpbmRvdyIsInNob3dNZVBhc3N3b3JkIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsImZpcnN0UGFzc3dvcmQiLCJzZWNvbmRQYXNzd29yZCIsInR5cGUiLCJjbGFzc0xpc3QiLCJhZGQiLCJxdWVyeVNlbGVjdG9yQWxsIiwibGVuZ3RoIiwicGxhaW5WYWxpZGF0aW9uIiwicGFzc3dvcmRGaXJzdCIsInBhc3N3b3JkU2Vjb25kIiwic3VibWl0IiwicmVtb3ZlIiwicXVlcnlTZWxlY3RvciIsIkFycmF5IiwiZnJvbSIsImZvckVhY2giLCJ0b2FzdE5vZGUiLCJzaG93IiwicHJvdG90eXBlIiwic2xpY2UiLCJjYWxsIiwiZm9ybSIsImNoZWNrVmFsaWRpdHkiLCJwcmV2ZW50RGVmYXVsdCIsInN0b3BQcm9wYWdhdGlvbiIsInZlbmRvclNlY3VyaXR5X3Bob25lIiwibWFza09wdGlvbnMiLCJtYXNrIiwib3ZlcndyaXRlIiwic3RhcnRTdGltdWx1c0FwcCIsImFwcCIsImNvbnRleHQiXSwic291cmNlUm9vdCI6IiJ9