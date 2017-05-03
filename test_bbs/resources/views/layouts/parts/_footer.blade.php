    <!-- jQuery -->
    {{ Html::script('js/jquery.js') }}
    <!-- Bootstrap Core JavaScript -->
    {{ Html::script('js/app.js') }}

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<!--
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
-->
    <!-- Contact Form JavaScript -->
    {{ Html::script('js/jqBootstrapValidation.js') }}

<!-- submit one click hidden -->
<script language="javascript">
//submit 連打対策
function disableSubmit(form) {
  var res = check();
  if(res == false) {
      return false;
  }
  var elements = form.elements;

  for (var i = 0; i < elements.length; i++) {
    if (elements[i].type == 'submit') {
      elements[i].disabled = true;
    }
  }
}

//submit 連打対策
function disableSubmitNoAlart(form) {
  var elements = form.elements;

  for (var i = 0; i < elements.length; i++) {
    if (elements[i].type == 'submit') {
      elements[i].disabled = true;
    }
  }
}

function check(){
    if(window.confirm('本当によろしいですか？')){ // 確認ダイアログを表示
        return true; // 「OK」時は送信を実行
    }
    else{ // 「キャンセル」時の処理
        window.alert('キャンセルされました'); // 警告ダイアログを表示
        return false; // 送信を中止
    }
}

//ラジオボタン全チェック用
function checkAll(element, filter, checked)
{
  var regExp = new RegExp(filter);
  
  for (var i = 0; i < element.childNodes.length; i++)
  {
    var node = element.childNodes[i];
    if (node.type == "radio" || node.type == "checkbox")
    {
      if (node.name.match(regExp))
      {
        node.checked = checked;
      }
    }
    else
    {
  	  checkAll(node, filter, checked);
    }
  }
}

//リスト折り畳み状態保持
/*!
 * JavaScript Cookie v2.1.3
 * https://github.com/js-cookie/js-cookie
 *
 * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
 * Released under the MIT license
 */
;(function (factory) {
	var registeredInModuleLoader = false;
	if (typeof define === 'function' && define.amd) {
		define(factory);
		registeredInModuleLoader = true;
	}
	if (typeof exports === 'object') {
		module.exports = factory();
		registeredInModuleLoader = true;
	}
	if (!registeredInModuleLoader) {
		var OldCookies = window.Cookies;
		var api = window.Cookies = factory();
		api.noConflict = function () {
			window.Cookies = OldCookies;
			return api;
		};
	}
}(function () {
	function extend () {
		var i = 0;
		var result = {};
		for (; i < arguments.length; i++) {
			var attributes = arguments[ i ];
			for (var key in attributes) {
				result[key] = attributes[key];
			}
		}
		return result;
	}

	function init (converter) {
		function api (key, value, attributes) {
			var result;
			if (typeof document === 'undefined') {
				return;
			}

			// Write

			if (arguments.length > 1) {
				attributes = extend({
					path: '/'
				}, api.defaults, attributes);

				if (typeof attributes.expires === 'number') {
					var expires = new Date();
					expires.setMilliseconds(expires.getMilliseconds() + attributes.expires * 864e+5);
					attributes.expires = expires;
				}

				// We're using "expires" because "max-age" is not supported by IE
				attributes.expires = attributes.expires ? attributes.expires.toUTCString() : '';

				try {
					result = JSON.stringify(value);
					if (/^[\{\[]/.test(result)) {
						value = result;
					}
				} catch (e) {}

				if (!converter.write) {
					value = encodeURIComponent(String(value))
						.replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);
				} else {
					value = converter.write(value, key);
				}

				key = encodeURIComponent(String(key));
				key = key.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent);
				key = key.replace(/[\(\)]/g, escape);

				var stringifiedAttributes = '';

				for (var attributeName in attributes) {
					if (!attributes[attributeName]) {
						continue;
					}
					stringifiedAttributes += '; ' + attributeName;
					if (attributes[attributeName] === true) {
						continue;
					}
					stringifiedAttributes += '=' + attributes[attributeName];
				}
				return (document.cookie = key + '=' + value + stringifiedAttributes);
			}

			// Read

			if (!key) {
				result = {};
			}

			// To prevent the for loop in the first place assign an empty array
			// in case there are no cookies at all. Also prevents odd result when
			// calling "get()"
			var cookies = document.cookie ? document.cookie.split('; ') : [];
			var rdecode = /(%[0-9A-Z]{2})+/g;
			var i = 0;

			for (; i < cookies.length; i++) {
				var parts = cookies[i].split('=');
				var cookie = parts.slice(1).join('=');

				if (cookie.charAt(0) === '"') {
					cookie = cookie.slice(1, -1);
				}

				try {
					var name = parts[0].replace(rdecode, decodeURIComponent);
					cookie = converter.read ?
						converter.read(cookie, name) : converter(cookie, name) ||
						cookie.replace(rdecode, decodeURIComponent);

					if (this.json) {
						try {
							cookie = JSON.parse(cookie);
						} catch (e) {}
					}

					if (key === name) {
						result = cookie;
						break;
					}

					if (!key) {
						result[name] = cookie;
					}
				} catch (e) {}
			}

			return result;
		}

		api.set = api;
		api.get = function (key) {
			return api.call(api, key);
		};
		api.getJSON = function () {
			return api.apply({
				json: true
			}, [].slice.call(arguments));
		};
		api.defaults = {};

		api.remove = function (key, attributes) {
			api(key, '', extend(attributes, {
				expires: -1
			}));
		};

		api.withConverter = init;

		return api;
	}

	return init(function () {});
}));

$(document).ready(function () {
  //when a group is shown, save it as the active accordion group
  $("#accordion").on('shown.bs.collapse', function () {
      var active = $("#accordion .in").attr('id');
      Cookies.set('activeAccordionGroup', active, { expires: 7 });
//      alert(active);
  });
  $("#accordion").on('hidden.bs.collapse', function () {
      Cookies.remove('activeAccordionGroup');
  });
  var last = Cookies.get('activeAccordionGroup');
  if (last != null) {
    //remove default collapse settings
    $("#accordion .collapse").removeClass('in');
    //show the account_last visible group
    $("#" + last).addClass("in");
  }
});

// テーブルに色付けをする関数
// 色付けするテーブルクラスはデフォルトでは"hiTable"ですが
//   グローバル変数 hiTableClasses
// にクラス名の正規表現パターンをセットすることにより指定できます。
//   文字の色         textColor     デフォルト white
//   ヘッダ部の文字色 headTextColor デフォルト white
//   ラインの色       lineColor     デフォルト #222222
//   ヘッダ部の色     headColor     デフォルト #000066
//   奇数行の色       oddColor      デフォルト #006666
//   偶数行の色       evenColor     デフォルト #004466
// デフォルトでは2pxのラインを書きますが、line属性でラインを書く/書かない
// および書く場合の幅を指定できます。
//   line='1px' : 1pxのラインを書く　数値px で幅指定
//   line=no    : ラインをこの関数では書かない
// 例えば
//   <table class=hiTable headColor=red>...</table>
// とするとヘッダ部が赤のテーブルとなります。
// textColorが指定されheadTextColorが指定されない場合、ヘッダの文字列も
// textColorとなります。
// lineColorはboder-collaspeが"collaspe"の場合は無効です。
//
var hiTableClasses;
function hiTable(){
   var tables= document.getElementsByTagName("table");
   if( hiTableClasses==undefined ) hiTableClasses="noTemplate";
   for(var t=0;t<tables.length;++t){
      var table=tables[t];
      if( !table.className.match(hiTableClasses) ){
         hiSetTableColor(table);
         }
      }
   }
function hiAttrVal(obj,name,dflt){
   if( !obj.getAttributeNode(name) )return dflt;
   return obj.getAttributeNode(name).value;
   }
// 直接テーブルobjectを指定することもできます。
function hiSetTableColor(table){
   var textColor= hiAttrVal(table,"textColor","#424242");  // 文字の色
   var lineColor= hiAttrVal(table,"lineColor","white");// 線の色
   table.style.color= textColor;
   var line= hiAttrVal(table,"line","0");
   if( line!='no' ){
      table.style.borderWidth   = line;
      table.style.borderStyle   = 'solid';
      table.style.borderColor   = lineColor;
      table.style.borderCollapse= "collapse";
      var borderWidth = table.style.borderWidth;
      ths = table.getElementsByTagName("th");
      for(var hi=0;hi<ths.length;++hi){
         if( ths[hi].style.borderWidth!="" ) continue;
         ths[hi].style.borderWidth= borderWidth;
         ths[hi].style.borderStyle= 'solid';
         ths[hi].style.borderColor= lineColor;
         }
      tds = table.getElementsByTagName("td");
      for(var di=0;di<tds.length;++di){
         if( tds[di].style.borderWidth!="" ) continue;
         tds[di].style.borderWidth= borderWidth;
         tds[di].style.borderStyle= 'solid';
         tds[di].style.borderColor= lineColor;
         }
      }
   // ヘッダ部
   if( table.tHead != undefined ){
      var headColor= hiAttrVal(table,"headColor","white"); // ヘッダの色
      var headTextColor= hiAttrVal(table,"headTextColor",textColor);
      var hrows=table.tHead.rows;
      for(var hr=0;hr<hrows.length;++hr){
         hrows[hr].style.color          = headTextColor;
         hrows[hr].style.backgroundColor= headColor;
         }
      }
   // ボディー部
   if( table.tBodies != undefined ){
      var oddColor = hiAttrVal(table,"oddColor","#E0F2F7"); //奇数行の色
      var evenColor= hiAttrVal(table,"evenColor","white");//偶数行の色
      bodies= table.tBodies;
      for(var b=0;b<bodies.length;++b){
         var rows=bodies[b].rows;
         for(var r=0;r<rows.length;++r){
            rows[r].style.backgroundColor= r%2==0?evenColor:oddColor;
            }
         }
      }
   }
try{
   window.addEventListener("load",hiTable,false);
   }
catch(e){
   window.attachEvent("onload",hiTable);
   }

</script>
    <!-- Custom Theme JavaScript -->
<!--
    <script src="js/agency.js"></script>
-->
