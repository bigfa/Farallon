var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        if (typeof b !== "function" && b !== null)
            throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
if (document.querySelector('.archive-header')) {
    var self_1 = document.querySelector('.archive-header');
    var id = self_1.dataset.id;
    fetch("/api/archive/".concat(id));
}
//@ts-ignore
if (obvInit.is_single) {
    //@ts-ignore
    var id = obvInit.post_id;
    fetch("/api/single/".concat(id));
}
var farallonBase = /** @class */ (function () {
    function farallonBase() {
    }
    return farallonBase;
}());
new farallonBase();
var farallonAction = /** @class */ (function (_super) {
    __extends(farallonAction, _super);
    function farallonAction() {
        return _super.call(this) || this;
    }
    farallonAction.prototype.refresh = function () { };
    return farallonAction;
}(farallonBase));
var farallonDate = /** @class */ (function () {
    function farallonDate(config) {
        this.doms = [];
        this.selector = config.selector;
        this.init();
    }
    farallonDate.prototype.init = function () {
        var _this = this;
        this.doms = Array.from(document.querySelectorAll(this.selector));
        this.doms.forEach(function (dom) {
            dom.innerText = _this.humanize_time_ago(dom.attributes['datetime'].value);
        });
    };
    farallonDate.prototype.humanize_time_ago = function (datetime) {
        var time = new Date(datetime);
        var between = Date.now() / 1000 - Number(time.getTime() / 1000);
        if (between < 3600) {
            return "".concat(Math.ceil(between / 60), " \u5206\u949F\u524D");
        }
        else if (between < 86400) {
            return "".concat(Math.ceil(between / 3600), " \u5C0F\u65F6\u524D");
        }
        else if (between < 86400 * 30) {
            return "".concat(Math.ceil(between / (86400 * 24)), " \u5929\u524D");
        }
        else {
            return "".concat(Math.ceil(between / (86400 * 24 * 30)), " \u6708\u524D");
        }
    };
    farallonDate.prototype.refresh = function () { };
    return farallonDate;
}());
new farallonDate({
    selector: 'time'
});
var farallonScroll = /** @class */ (function () {
    function farallonScroll() {
        this.init();
    }
    farallonScroll.prototype.init = function () {
        this.scroll();
    };
    farallonScroll.prototype.scroll = function () {
        // let scroll = new SmoothScroll('a[href*="#"]', {
        //     speed: 500,
        //     speedAsDuration: true
        // });
    };
    return farallonScroll;
}());
new farallonScroll();
