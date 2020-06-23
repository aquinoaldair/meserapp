/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/custom.js":
/*!********************************!*\
  !*** ./resources/js/custom.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var DataTablesCustom = function () {
  var datatableEl = $('#datatable');

  var initDataTables = function initDataTables() {
    if (datatableEl.length) {
      datatableEl.DataTable();
    }
  };

  var datatableElButtons = $('#datatableButtons');

  var initDataTablesButtons = function initDataTablesButtons() {
    console.log("iniciar datatables buttons");

    if (datatableElButtons.length) {
      datatableElButtons.DataTable({
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
          },
          className: 'btn-success'
        }]
      });
    }
  };

  var initDataTablesDeleteItems = function initDataTablesDeleteItems() {
    datatableEl.on("click", ".destroy", function (e) {
      e.preventDefault();
      var row = $(this).parents('tr');
      var id = row.data('id');
      var form = $('#form-destroy');
      var url = form.attr('action').replace(':data-id', id);
      var data = form.serialize(); //inicio del swal

      swal({
        title: "Esta seguro de eliminarlo?",
        text: "Una vez eliminado no podras revertir esta acción",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(function (willDelete) {
        if (willDelete) {
          $.ajax({
            method: "DELETE",
            url: url,
            data: data
          }).done(function (data) {
            console.log(data);
            row.fadeOut();
            swal("El registro ha sido eliminado.", {
              icon: "success"
            });
          }).fail(function (data) {
            console.log(data);
            swal("Ocurrio un error al eliminar el registro, intentelo de nuevo o contacte con su administrador", {
              icon: "error"
            });
          });
        }
      }); // fin del swal
    });
  };

  return {
    init: function init() {
      initDataTables();
      initDataTablesDeleteItems();
      initDataTablesButtons();
    }
  };
}();

var RoomDelete = function () {
  var initButton = function initButton() {
    $(".room-delete").click(function () {
      var key = $(this).attr('data-key');
      var form = $('#form-destroy');
      var url = form.attr('action').replace(':data-id', key);
      var data = form.serialize();
      var el = $("#" + key);
      swal({
        title: "Esta seguro de eliminarlo?",
        text: "Una vez eliminado no podras revertir esta acción",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(function (willDelete) {
        if (willDelete) {
          $.ajax({
            method: "DELETE",
            url: url,
            data: data
          }).done(function (data) {
            console.log(key);
            el.remove();
            swal("El registro ha sido eliminado.", {
              icon: "success"
            });
          }).fail(function (data) {
            console.log(data);
            swal("Ocurrio un error al eliminar el registro, intentelo de nuevo o contacte con su administrador", {
              icon: "error"
            });
          });
        }
      });
    });
  };

  return {
    init: function init() {
      initButton();
    }
  };
}();

var DataTablesCustomByClass = function () {
  var datatableEl = $('.datatable');

  var initDataTables = function initDataTables() {
    if (datatableEl.length) {
      datatableEl.DataTable();
    }
  };

  var datatableElButtons = $('.datatableButtons');

  var initDataTablesButtons = function initDataTablesButtons() {
    if (datatableElButtons.length) {
      datatableElButtons.DataTable({
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
          },
          className: 'btn-success'
        }]
      });
    }
  };

  return {
    init: function init() {
      initDataTables();
      initDataTablesButtons();
    }
  };
}();

$(document).ready(function () {
  DataTablesCustom.init();
  RoomDelete.init();
  DataTablesCustomByClass.init();
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!****************************************************************!*\
  !*** multi ./resources/js/custom.js ./resources/sass/app.scss ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/aldairantonioaquino/Developer/Laravel/Personal/meserapp/resources/js/custom.js */"./resources/js/custom.js");
module.exports = __webpack_require__(/*! /Users/aldairantonioaquino/Developer/Laravel/Personal/meserapp/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });