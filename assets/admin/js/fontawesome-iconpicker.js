/*!
 * Font Awesome Icon Picker
 * https://farbelous.github.io/fontawesome-iconpicker/
 *
 * @author Javi Aguilar, itsjavi.com
 * @license MIT License
 * @see https://github.com/farbelous/fontawesome-iconpicker/blob/master/LICENSE
 */


(function(e) {
    if (typeof define === "function" && define.amd) {
        define([ "jquery" ], e);
    } else {
        e(jQuery);
    }
})(function(j) {
    j.ui = j.ui || {};
    var e = j.ui.version = "1.12.1";
    (function() {
        var r, y = Math.max, x = Math.abs, s = /left|center|right/, i = /top|center|bottom/, f = /[\+\-]\d+(\.[\d]+)?%?/, l = /^\w+/, c = /%$/, a = j.fn.pos;
        function q(e, a, t) {
            return [ parseFloat(e[0]) * (c.test(e[0]) ? a / 100 : 1), parseFloat(e[1]) * (c.test(e[1]) ? t / 100 : 1) ];
        }
        function C(e, a) {
            return parseInt(j.css(e, a), 10) || 0;
        }
        function t(e) {
            var a = e[0];
            if (a.nodeType === 9) {
                return {
                    width: e.width(),
                    height: e.height(),
                    offset: {
                        top: 0,
                        left: 0
                    }
                };
            }
            if (j.isWindow(a)) {
                return {
                    width: e.width(),
                    height: e.height(),
                    offset: {
                        top: e.scrollTop(),
                        left: e.scrollLeft()
                    }
                };
            }
            if (a.preventDefault) {
                return {
                    width: 0,
                    height: 0,
                    offset: {
                        top: a.pageY,
                        left: a.pageX
                    }
                };
            }
            return {
                width: e.outerWidth(),
                height: e.outerHeight(),
                offset: e.offset()
            };
        }
        j.pos = {
            scrollbarWidth: function() {
                if (r !== undefined) {
                    return r;
                }
                var e, a, t = j("<div " + "style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'>" + "<div style='height:100px;width:auto;'></div></div>"), s = t.children()[0];
                j("body").append(t);
                e = s.offsetWidth;
                t.css("overflow", "scroll");
                a = s.offsetWidth;
                if (e === a) {
                    a = t[0].clientWidth;
                }
                t.remove();
                return r = e - a;
            },
            getScrollInfo: function(e) {
                var a = e.isWindow || e.isDocument ? "" : e.element.css("overflow-x"), t = e.isWindow || e.isDocument ? "" : e.element.css("overflow-y"), s = a === "scroll" || a === "auto" && e.width < e.element[0].scrollWidth, r = t === "scroll" || t === "auto" && e.height < e.element[0].scrollHeight;
                return {
                    width: r ? j.pos.scrollbarWidth() : 0,
                    height: s ? j.pos.scrollbarWidth() : 0
                };
            },
            getWithinInfo: function(e) {
                var a = j(e || window), t = j.isWindow(a[0]), s = !!a[0] && a[0].nodeType === 9, r = !t && !s;
                return {
                    element: a,
                    isWindow: t,
                    isDocument: s,
                    offset: r ? j(e).offset() : {
                        left: 0,
                        top: 0
                    },
                    scrollLeft: a.scrollLeft(),
                    scrollTop: a.scrollTop(),
                    width: a.outerWidth(),
                    height: a.outerHeight()
                };
            }
        };
        j.fn.pos = function(h) {
            if (!h || !h.of) {
                return a.apply(this, arguments);
            }
            h = j.extend({}, h);
            var m, p, d, u, T, e, g = j(h.of), b = j.pos.getWithinInfo(h.within), k = j.pos.getScrollInfo(b), w = (h.collision || "flip").split(" "), v = {};
            e = t(g);
            if (g[0].preventDefault) {
                h.at = "left top";
            }
            p = e.width;
            d = e.height;
            u = e.offset;
            T = j.extend({}, u);
            j.each([ "my", "at" ], function() {
                var e = (h[this] || "").split(" "), a, t;
                if (e.length === 1) {
                    e = s.test(e[0]) ? e.concat([ "center" ]) : i.test(e[0]) ? [ "center" ].concat(e) : [ "center", "center" ];
                }
                e[0] = s.test(e[0]) ? e[0] : "center";
                e[1] = i.test(e[1]) ? e[1] : "center";
                a = f.exec(e[0]);
                t = f.exec(e[1]);
                v[this] = [ a ? a[0] : 0, t ? t[0] : 0 ];
                h[this] = [ l.exec(e[0])[0], l.exec(e[1])[0] ];
            });
            if (w.length === 1) {
                w[1] = w[0];
            }
            if (h.at[0] === "right") {
                T.left += p;
            } else if (h.at[0] === "center") {
                T.left += p / 2;
            }
            if (h.at[1] === "bottom") {
                T.top += d;
            } else if (h.at[1] === "center") {
                T.top += d / 2;
            }
            m = q(v.at, p, d);
            T.left += m[0];
            T.top += m[1];
            return this.each(function() {
                var t, e, f = j(this), l = f.outerWidth(), c = f.outerHeight(), a = C(this, "marginLeft"), s = C(this, "marginTop"), r = l + a + C(this, "marginRight") + k.width, i = c + s + C(this, "marginBottom") + k.height, o = j.extend({}, T), n = q(v.my, f.outerWidth(), f.outerHeight());
                if (h.my[0] === "right") {
                    o.left -= l;
                } else if (h.my[0] === "center") {
                    o.left -= l / 2;
                }
                if (h.my[1] === "bottom") {
                    o.top -= c;
                } else if (h.my[1] === "center") {
                    o.top -= c / 2;
                }
                o.left += n[0];
                o.top += n[1];
                t = {
                    marginLeft: a,
                    marginTop: s
                };
                j.each([ "left", "top" ], function(e, a) {
                    if (j.ui.pos[w[e]]) {
                        j.ui.pos[w[e]][a](o, {
                            targetWidth: p,
                            targetHeight: d,
                            elemWidth: l,
                            elemHeight: c,
                            collisionPosition: t,
                            collisionWidth: r,
                            collisionHeight: i,
                            offset: [ m[0] + n[0], m[1] + n[1] ],
                            my: h.my,
                            at: h.at,
                            within: b,
                            elem: f
                        });
                    }
                });
                if (h.using) {
                    e = function(e) {
                        var a = u.left - o.left, t = a + p - l, s = u.top - o.top, r = s + d - c, i = {
                            target: {
                                element: g,
                                left: u.left,
                                top: u.top,
                                width: p,
                                height: d
                            },
                            element: {
                                element: f,
                                left: o.left,
                                top: o.top,
                                width: l,
                                height: c
                            },
                            horizontal: t < 0 ? "left" : a > 0 ? "right" : "center",
                            vertical: r < 0 ? "top" : s > 0 ? "bottom" : "middle"
                        };
                        if (p < l && x(a + t) < p) {
                            i.horizontal = "center";
                        }
                        if (d < c && x(s + r) < d) {
                            i.vertical = "middle";
                        }
                        if (y(x(a), x(t)) > y(x(s), x(r))) {
                            i.important = "horizontal";
                        } else {
                            i.important = "vertical";
                        }
                        h.using.call(this, e, i);
                    };
                }
                f.offset(j.extend(o, {
                    using: e
                }));
            });
        };
        j.ui.pos = {
            _trigger: function(e, a, t, s) {
                if (a.elem) {
                    a.elem.trigger({
                        type: t,
                        position: e,
                        positionData: a,
                        triggered: s
                    });
                }
            },
            fit: {
                left: function(e, a) {
                    j.ui.pos._trigger(e, a, "posCollide", "fitLeft");
                    var t = a.within, s = t.isWindow ? t.scrollLeft : t.offset.left, r = t.width, i = e.left - a.collisionPosition.marginLeft, f = s - i, l = i + a.collisionWidth - r - s, c;
                    if (a.collisionWidth > r) {
                        if (f > 0 && l <= 0) {
                            c = e.left + f + a.collisionWidth - r - s;
                            e.left += f - c;
                        } else if (l > 0 && f <= 0) {
                            e.left = s;
                        } else {
                            if (f > l) {
                                e.left = s + r - a.collisionWidth;
                            } else {
                                e.left = s;
                            }
                        }
                    } else if (f > 0) {
                        e.left += f;
                    } else if (l > 0) {
                        e.left -= l;
                    } else {
                        e.left = y(e.left - i, e.left);
                    }
                    j.ui.pos._trigger(e, a, "posCollided", "fitLeft");
                },
                top: function(e, a) {
                    j.ui.pos._trigger(e, a, "posCollide", "fitTop");
                    var t = a.within, s = t.isWindow ? t.scrollTop : t.offset.top, r = a.within.height, i = e.top - a.collisionPosition.marginTop, f = s - i, l = i + a.collisionHeight - r - s, c;
                    if (a.collisionHeight > r) {
                        if (f > 0 && l <= 0) {
                            c = e.top + f + a.collisionHeight - r - s;
                            e.top += f - c;
                        } else if (l > 0 && f <= 0) {
                            e.top = s;
                        } else {
                            if (f > l) {
                                e.top = s + r - a.collisionHeight;
                            } else {
                                e.top = s;
                            }
                        }
                    } else if (f > 0) {
                        e.top += f;
                    } else if (l > 0) {
                        e.top -= l;
                    } else {
                        e.top = y(e.top - i, e.top);
                    }
                    j.ui.pos._trigger(e, a, "posCollided", "fitTop");
                }
            },
            flip: {
                left: function(e, a) {
                    j.ui.pos._trigger(e, a, "posCollide", "flipLeft");
                    var t = a.within, s = t.offset.left + t.scrollLeft, r = t.width, i = t.isWindow ? t.scrollLeft : t.offset.left, f = e.left - a.collisionPosition.marginLeft, l = f - i, c = f + a.collisionWidth - r - i, o = a.my[0] === "left" ? -a.elemWidth : a.my[0] === "right" ? a.elemWidth : 0, n = a.at[0] === "left" ? a.targetWidth : a.at[0] === "right" ? -a.targetWidth : 0, h = -2 * a.offset[0], m, p;
                    if (l < 0) {
                        m = e.left + o + n + h + a.collisionWidth - r - s;
                        if (m < 0 || m < x(l)) {
                            e.left += o + n + h;
                        }
                    } else if (c > 0) {
                        p = e.left - a.collisionPosition.marginLeft + o + n + h - i;
                        if (p > 0 || x(p) < c) {
                            e.left += o + n + h;
                        }
                    }
                    j.ui.pos._trigger(e, a, "posCollided", "flipLeft");
                },
                top: function(e, a) {
                    j.ui.pos._trigger(e, a, "posCollide", "flipTop");
                    var t = a.within, s = t.offset.top + t.scrollTop, r = t.height, i = t.isWindow ? t.scrollTop : t.offset.top, f = e.top - a.collisionPosition.marginTop, l = f - i, c = f + a.collisionHeight - r - i, o = a.my[1] === "top", n = o ? -a.elemHeight : a.my[1] === "bottom" ? a.elemHeight : 0, h = a.at[1] === "top" ? a.targetHeight : a.at[1] === "bottom" ? -a.targetHeight : 0, m = -2 * a.offset[1], p, d;
                    if (l < 0) {
                        d = e.top + n + h + m + a.collisionHeight - r - s;
                        if (d < 0 || d < x(l)) {
                            e.top += n + h + m;
                        }
                    } else if (c > 0) {
                        p = e.top - a.collisionPosition.marginTop + n + h + m - i;
                        if (p > 0 || x(p) < c) {
                            e.top += n + h + m;
                        }
                    }
                    j.ui.pos._trigger(e, a, "posCollided", "flipTop");
                }
            },
            flipfit: {
                left: function() {
                    j.ui.pos.flip.left.apply(this, arguments);
                    j.ui.pos.fit.left.apply(this, arguments);
                },
                top: function() {
                    j.ui.pos.flip.top.apply(this, arguments);
                    j.ui.pos.fit.top.apply(this, arguments);
                }
            }
        };
        (function() {
            var e, a, t, s, r, i = document.getElementsByTagName("body")[0], f = document.createElement("div");
            e = document.createElement(i ? "div" : "body");
            t = {
                visibility: "hidden",
                width: 0,
                height: 0,
                border: 0,
                margin: 0,
                background: "none"
            };
            if (i) {
                j.extend(t, {
                    position: "absolute",
                    left: "-1000px",
                    top: "-1000px"
                });
            }
            for (r in t) {
                e.style[r] = t[r];
            }
            e.appendChild(f);
            a = i || document.documentElement;
            a.insertBefore(e, a.firstChild);
            f.style.cssText = "position: absolute; left: 10.7432222px;";
            s = j(f).offset().left;
            j.support.offsetFractions = s > 10 && s < 11;
            e.innerHTML = "";
            a.removeChild(e);
        })();
    })();
    var a = j.ui.position;
});

(function(e) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "jquery" ], e);
    } else if (window.jQuery && !window.jQuery.fn.iconpicker) {
        e(window.jQuery);
    }
})(function(c) {
    "use strict";
    var f = {
        isEmpty: function(e) {
            return e === false || e === "" || e === null || e === undefined;
        },
        isEmptyObject: function(e) {
            return this.isEmpty(e) === true || e.length === 0;
        },
        isElement: function(e) {
            return c(e).length > 0;
        },
        isString: function(e) {
            return typeof e === "string" || e instanceof String;
        },
        isArray: function(e) {
            return c.isArray(e);
        },
        inArray: function(e, a) {
            return c.inArray(e, a) !== -1;
        },
        throwError: function(e) {
            throw "Font Awesome Icon Picker Exception: " + e;
        }
    };
    var t = function(e, a) {
        this._id = t._idCounter++;
        this.element = c(e).addClass("iconpicker-element");
        this._trigger("iconpickerCreate", {
            iconpickerValue: this.iconpickerValue
        });
        this.options = c.extend({}, t.defaultOptions, this.element.data(), a);
        this.options.templates = c.extend({}, t.defaultOptions.templates, this.options.templates);
        this.options.originalPlacement = this.options.placement;
        this.container = f.isElement(this.options.container) ? c(this.options.container) : false;
        if (this.container === false) {
            if (this.element.is(".dropdown-toggle")) {
                this.container = c("~ .dropdown-menu:first", this.element);
            } else {
                this.container = this.element.is("input,textarea,button,.btn") ? this.element.parent() : this.element;
            }
        }
        this.container.addClass("iconpicker-container");
        if (this.isDropdownMenu()) {
            this.options.placement = "inline";
        }
        this.input = this.element.is("input,textarea") ? this.element.addClass("iconpicker-input") : false;
        if (this.input === false) {
            this.input = this.container.find(this.options.input);
            if (!this.input.is("input,textarea")) {
                this.input = false;
            }
        }
        this.component = this.isDropdownMenu() ? this.container.parent().find(this.options.component) : this.container.find(this.options.component);
        if (this.component.length === 0) {
            this.component = false;
        } else {
            this.component.find("i").addClass("iconpicker-component");
        }
        this._createPopover();
        this._createIconpicker();
        if (this.getAcceptButton().length === 0) {
            this.options.mustAccept = false;
        }
        if (this.isInputGroup()) {
            this.container.parent().append(this.popover);
        } else {
            this.container.append(this.popover);
        }
        this._bindElementEvents();
        this._bindWindowEvents();
        this.update(this.options.selected);
        if (this.isInline()) {
            this.show();
        }
        this._trigger("iconpickerCreated", {
            iconpickerValue: this.iconpickerValue
        });
    };
    t._idCounter = 0;
    t.defaultOptions = {
        title: false,
        selected: false,
        defaultValue: false,
        placement: "bottom",
        collision: "none",
        animation: true,
        hideOnSelect: false,
        showFooter: false,
        searchInFooter: false,
        mustAccept: false,
        selectedCustomClass: "bg-primary",
        icons: [],
        fullClassFormatter: function(e) {
            return e;
        },
        input: "input,.iconpicker-input",
        inputSearch: false,
        container: false,
        component: ".input-group-addon,.iconpicker-component",
        templates: {
            popover: '<div class="iconpicker-popover popover"><div class="arrow"></div>' + '<div class="popover-title"></div><div class="popover-content"></div></div>',
            footer: '<div class="popover-footer"></div>',
            buttons: '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button>' + ' <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
            search: '<input type="search" class="form-control iconpicker-search" placeholder="Type to filter" />',
            iconpicker: '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
            iconpickerItem: '<a role="button" href="javascript:;" class="iconpicker-item"><i></i></a>'
        }
    };
    t.batch = function(e, a) {
        var t = Array.prototype.slice.call(arguments, 2);
        return c(e).each(function() {
            var e = c(this).data("iconpicker");
            if (!!e) {
                e[a].apply(e, t);
            }
        });
    };
    t.prototype = {
        constructor: t,
        options: {},
        _id: 0,
        _trigger: function(e, a) {
            a = a || {};
            this.element.trigger(c.extend({
                type: e,
                iconpickerInstance: this
            }, a));
        },
        _createPopover: function() {
            this.popover = c(this.options.templates.popover);
            var e = this.popover.find(".popover-title");
            if (!!this.options.title) {
                e.append(c('<div class="popover-title-text">' + this.options.title + "</div>"));
            }
            if (this.hasSeparatedSearchInput() && !this.options.searchInFooter) {
                e.append(this.options.templates.search);
            } else if (!this.options.title) {
                e.remove();
            }
            if (this.options.showFooter && !f.isEmpty(this.options.templates.footer)) {
                var a = c(this.options.templates.footer);
                if (this.hasSeparatedSearchInput() && this.options.searchInFooter) {
                    a.append(c(this.options.templates.search));
                }
                if (!f.isEmpty(this.options.templates.buttons)) {
                    a.append(c(this.options.templates.buttons));
                }
                this.popover.append(a);
            }
            if (this.options.animation === true) {
                this.popover.addClass("fade");
            }
            return this.popover;
        },
        _createIconpicker: function() {
            var t = this;
            this.iconpicker = c(this.options.templates.iconpicker);
            var e = function(e) {
                var a = c(this);
                if (a.is("i")) {
                    a = a.parent();
                }
                t._trigger("iconpickerSelect", {
                    iconpickerItem: a,
                    iconpickerValue: t.iconpickerValue
                });
                if (t.options.mustAccept === false) {
                    t.update(a.data("iconpickerValue"));
                    t._trigger("iconpickerSelected", {
                        iconpickerItem: this,
                        iconpickerValue: t.iconpickerValue
                    });
                } else {
                    t.update(a.data("iconpickerValue"), true);
                }
                if (t.options.hideOnSelect && t.options.mustAccept === false) {
                    t.hide();
                }
            };
            var a = c(this.options.templates.iconpickerItem);
            var s = [];
            for (var r in this.options.icons) {
                if (typeof this.options.icons[r].title === "string") {
                    var i = a.clone();
                    i.find("i").addClass(this.options.fullClassFormatter(this.options.icons[r].title));
                    i.data("iconpickerValue", this.options.icons[r].title).on("click.iconpicker", e);
                    i.attr("title", "." + this.options.icons[r].title);
                    if (this.options.icons[r].searchTerms.length > 0) {
                        var f = "";
                        for (var l = 0; l < this.options.icons[r].searchTerms.length; l++) {
                            f = f + this.options.icons[r].searchTerms[l] + " ";
                        }
                        i.attr("data-search-terms", f);
                    }
                    s.push(i);
                }
            }
            this.iconpicker.find(".iconpicker-items").append(s);
            this.popover.find(".popover-content").append(this.iconpicker);
            return this.iconpicker;
        },
        _isEventInsideIconpicker: function(e) {
            var a = c(e.target);
            if ((!a.hasClass("iconpicker-element") || a.hasClass("iconpicker-element") && !a.is(this.element)) && a.parents(".iconpicker-popover").length === 0) {
                return false;
            }
            return true;
        },
        _bindElementEvents: function() {
            var a = this;
            this.getSearchInput().on("keyup.iconpicker", function() {
                a.filter(c(this).val().toLowerCase());
            });
            this.getAcceptButton().on("click.iconpicker", function() {
                var e = a.iconpicker.find(".iconpicker-selected").get(0);
                a.update(a.iconpickerValue);
                a._trigger("iconpickerSelected", {
                    iconpickerItem: e,
                    iconpickerValue: a.iconpickerValue
                });
                if (!a.isInline()) {
                    a.hide();
                }
            });
            this.getCancelButton().on("click.iconpicker", function() {
                if (!a.isInline()) {
                    a.hide();
                }
            });
            this.element.on("focus.iconpicker", function(e) {
                a.show();
                e.stopPropagation();
            });
            if (this.hasComponent()) {
                this.component.on("click.iconpicker", function() {
                    a.toggle();
                });
            }
            if (this.hasInput()) {
                this.input.on("keyup.iconpicker", function(e) {
                    if (!f.inArray(e.keyCode, [ 38, 40, 37, 39, 16, 17, 18, 9, 8, 91, 93, 20, 46, 186, 190, 46, 78, 188, 44, 86 ])) {
                        a.update();
                    } else {
                        a._updateFormGroupStatus(a.getValid(this.value) !== false);
                    }
                    if (a.options.inputSearch === true) {
                        a.filter(c(this).val().toLowerCase());
                    }
                });
            }
        },
        _bindWindowEvents: function() {
            var e = c(window.document);
            var a = this;
            var t = ".iconpicker.inst" + this._id;
            c(window).on("resize.iconpicker" + t + " orientationchange.iconpicker" + t, function(e) {
                if (a.popover.hasClass("in")) {
                    a.updatePlacement();
                }
            });
            if (!a.isInline()) {
                e.on("mouseup" + t, function(e) {
                    if (!a._isEventInsideIconpicker(e) && !a.isInline()) {
                        a.hide();
                    }
                });
            }
        },
        _unbindElementEvents: function() {
            this.popover.off(".iconpicker");
            this.element.off(".iconpicker");
            if (this.hasInput()) {
                this.input.off(".iconpicker");
            }
            if (this.hasComponent()) {
                this.component.off(".iconpicker");
            }
            if (this.hasContainer()) {
                this.container.off(".iconpicker");
            }
        },
        _unbindWindowEvents: function() {
            c(window).off(".iconpicker.inst" + this._id);
            c(window.document).off(".iconpicker.inst" + this._id);
        },
        updatePlacement: function(e, a) {
            e = e || this.options.placement;
            this.options.placement = e;
            a = a || this.options.collision;
            a = a === true ? "flip" : a;
            var t = {
                at: "right bottom",
                my: "right top",
                of: this.hasInput() && !this.isInputGroup() ? this.input : this.container,
                collision: a === true ? "flip" : a,
                within: window
            };
            this.popover.removeClass("inline topLeftCorner topLeft top topRight topRightCorner " + "rightTop right rightBottom bottomRight bottomRightCorner " + "bottom bottomLeft bottomLeftCorner leftBottom left leftTop");
            if (typeof e === "object") {
                return this.popover.pos(c.extend({}, t, e));
            }
            switch (e) {
              case "inline":
                {
                    t = false;
                }
                break;

              case "topLeftCorner":
                {
                    t.my = "right bottom";
                    t.at = "left top";
                }
                break;

              case "topLeft":
                {
                    t.my = "left bottom";
                    t.at = "left top";
                }
                break;

              case "top":
                {
                    t.my = "center bottom";
                    t.at = "center top";
                }
                break;

              case "topRight":
                {
                    t.my = "right bottom";
                    t.at = "right top";
                }
                break;

              case "topRightCorner":
                {
                    t.my = "left bottom";
                    t.at = "right top";
                }
                break;

              case "rightTop":
                {
                    t.my = "left bottom";
                    t.at = "right center";
                }
                break;

              case "right":
                {
                    t.my = "left center";
                    t.at = "right center";
                }
                break;

              case "rightBottom":
                {
                    t.my = "left top";
                    t.at = "right center";
                }
                break;

              case "bottomRightCorner":
                {
                    t.my = "left top";
                    t.at = "right bottom";
                }
                break;

              case "bottomRight":
                {
                    t.my = "right top";
                    t.at = "right bottom";
                }
                break;

              case "bottom":
                {
                    t.my = "center top";
                    t.at = "center bottom";
                }
                break;

              case "bottomLeft":
                {
                    t.my = "left top";
                    t.at = "left bottom";
                }
                break;

              case "bottomLeftCorner":
                {
                    t.my = "right top";
                    t.at = "left bottom";
                }
                break;

              case "leftBottom":
                {
                    t.my = "right top";
                    t.at = "left center";
                }
                break;

              case "left":
                {
                    t.my = "right center";
                    t.at = "left center";
                }
                break;

              case "leftTop":
                {
                    t.my = "right bottom";
                    t.at = "left center";
                }
                break;

              default:
                {
                    return false;
                }
                break;
            }
            this.popover.css({
                display: this.options.placement === "inline" ? "" : "block"
            });
            if (t !== false) {
                this.popover.pos(t).css("maxWidth", c(window).width() - this.container.offset().left - 5);
            } else {
                this.popover.css({
                    top: "auto",
                    right: "auto",
                    bottom: "auto",
                    left: "auto",
                    maxWidth: "none"
                });
            }
            this.popover.addClass(this.options.placement);
            return true;
        },
        _updateComponents: function() {
            this.iconpicker.find(".iconpicker-item.iconpicker-selected").removeClass("iconpicker-selected " + this.options.selectedCustomClass);
            if (this.iconpickerValue) {
                this.iconpicker.find("." + this.options.fullClassFormatter(this.iconpickerValue).replace(/ /g, ".")).parent().addClass("iconpicker-selected " + this.options.selectedCustomClass);
            }
            if (this.hasComponent()) {
                var e = this.component.find("i");
                if (e.length > 0) {
                    e.attr("class", this.options.fullClassFormatter(this.iconpickerValue));
                } else {
                    this.component.html(this.getHtml());
                }
            }
        },
        _updateFormGroupStatus: function(e) {
            if (this.hasInput()) {
                if (e !== false) {
                    this.input.parents(".form-group:first").removeClass("has-error");
                } else {
                    this.input.parents(".form-group:first").addClass("has-error");
                }
                return true;
            }
            return false;
        },
        getValid: function(e) {
            if (!f.isString(e)) {
                e = "";
            }
            var a = e === "";
            e = c.trim(e);
            var t = false;
            for (var s = 0; s < this.options.icons.length; s++) {
                if (this.options.icons[s].title === e) {
                    t = true;
                    break;
                }
            }
            if (t || a) {
                return e;
            }
            return false;
        },
        setValue: function(e) {
            var a = this.getValid(e);
            if (a !== false) {
                this.iconpickerValue = a;
                this._trigger("iconpickerSetValue", {
                    iconpickerValue: a
                });
                return this.iconpickerValue;
            } else {
                this._trigger("iconpickerInvalid", {
                    iconpickerValue: e
                });
                return false;
            }
        },
        getHtml: function() {
            return '<i class="' + this.options.fullClassFormatter(this.iconpickerValue) + '"></i>';
        },
        setSourceValue: function(e) {
            e = this.setValue(e);
            if (e !== false && e !== "") {
                if (this.hasInput()) {
                    this.input.val(this.iconpickerValue);
                } else {
                    this.element.data("iconpickerValue", this.iconpickerValue);
                }
                this._trigger("iconpickerSetSourceValue", {
                    iconpickerValue: e
                });
            }
            return e;
        },
        getSourceValue: function(e) {
            e = e || this.options.defaultValue;
            var a = e;
            if (this.hasInput()) {
                a = this.input.val();
            } else {
                a = this.element.data("iconpickerValue");
            }
            if (a === undefined || a === "" || a === null || a === false) {
                a = e;
            }
            return a;
        },
        hasInput: function() {
            return this.input !== false;
        },
        isInputSearch: function() {
            return this.hasInput() && this.options.inputSearch === true;
        },
        isInputGroup: function() {
            return this.container.is(".input-group");
        },
        isDropdownMenu: function() {
            return this.container.is(".dropdown-menu");
        },
        hasSeparatedSearchInput: function() {
            return this.options.templates.search !== false && !this.isInputSearch();
        },
        hasComponent: function() {
            return this.component !== false;
        },
        hasContainer: function() {
            return this.container !== false;
        },
        getAcceptButton: function() {
            return this.popover.find(".iconpicker-btn-accept");
        },
        getCancelButton: function() {
            return this.popover.find(".iconpicker-btn-cancel");
        },
        getSearchInput: function() {
            return this.popover.find(".iconpicker-search");
        },
        filter: function(r) {
            if (f.isEmpty(r)) {
                this.iconpicker.find(".iconpicker-item").show();
                return c(false);
            } else {
                var i = [];
                this.iconpicker.find(".iconpicker-item").each(function() {
                    var e = c(this);
                    var a = e.attr("title").toLowerCase();
                    var t = e.attr("data-search-terms") ? e.attr("data-search-terms").toLowerCase() : "";
                    a = a + " " + t;
                    var s = false;
                    try {
                        s = new RegExp("(^|\\W)" + r, "g");
                    } catch (e) {
                        s = false;
                    }
                    if (s !== false && a.match(s)) {
                        i.push(e);
                        e.show();
                    } else {
                        e.hide();
                    }
                });
                return i;
            }
        },
        show: function() {
            if (this.popover.hasClass("in")) {
                return false;
            }
            c.iconpicker.batch(c(".iconpicker-popover.in:not(.inline)").not(this.popover), "hide");
            this._trigger("iconpickerShow", {
                iconpickerValue: this.iconpickerValue
            });
            this.updatePlacement();
            this.popover.addClass("in");
            setTimeout(c.proxy(function() {
                this.popover.css("display", this.isInline() ? "" : "block");
                this._trigger("iconpickerShown", {
                    iconpickerValue: this.iconpickerValue
                });
            }, this), this.options.animation ? 300 : 1);
        },
        hide: function() {
            if (!this.popover.hasClass("in")) {
                return false;
            }
            this._trigger("iconpickerHide", {
                iconpickerValue: this.iconpickerValue
            });
            this.popover.removeClass("in");
            setTimeout(c.proxy(function() {
                this.popover.css("display", "none");
                this.getSearchInput().val("");
                this.filter("");
                this._trigger("iconpickerHidden", {
                    iconpickerValue: this.iconpickerValue
                });
            }, this), this.options.animation ? 300 : 1);
        },
        toggle: function() {
            if (this.popover.is(":visible")) {
                this.hide();
            } else {
                this.show(true);
            }
        },
        update: function(e, a) {
            e = e ? e : this.getSourceValue(this.iconpickerValue);
            this._trigger("iconpickerUpdate", {
                iconpickerValue: this.iconpickerValue
            });
            if (a === true) {
                e = this.setValue(e);
            } else {
                e = this.setSourceValue(e);
                this._updateFormGroupStatus(e !== false);
            }
            if (e !== false) {
                this._updateComponents();
            }
            this._trigger("iconpickerUpdated", {
                iconpickerValue: this.iconpickerValue
            });
            return e;
        },
        destroy: function() {
            this._trigger("iconpickerDestroy", {
                iconpickerValue: this.iconpickerValue
            });
            this.element.removeData("iconpicker").removeData("iconpickerValue").removeClass("iconpicker-element");
            this._unbindElementEvents();
            this._unbindWindowEvents();
            c(this.popover).remove();
            this._trigger("iconpickerDestroyed", {
                iconpickerValue: this.iconpickerValue
            });
        },
        disable: function() {
            if (this.hasInput()) {
                this.input.prop("disabled", true);
                return true;
            }
            return false;
        },
        enable: function() {
            if (this.hasInput()) {
                this.input.prop("disabled", false);
                return true;
            }
            return false;
        },
        isDisabled: function() {
            if (this.hasInput()) {
                return this.input.prop("disabled") === true;
            }
            return false;
        },
        isInline: function() {
            return this.options.placement === "inline" || this.popover.hasClass("inline");
        }
    };
    c.iconpicker = t;
    c.fn.iconpicker = function(a) {
        return this.each(function() {
            var e = c(this);
            if (!e.data("iconpicker")) {
                e.data("iconpicker", new t(this, typeof a === "object" ? a : {}));
            }
        });
    };
    t.defaultOptions = c.extend(t.defaultOptions, {
        icons: [ 
        {
            title: "fab fa-500px",
            searchTerms: []
        }, {
            title: "fab fa-accessible-icon",
            searchTerms: [ "accessibility", "handicap", "person", "wheelchair", "wheelchair-alt" ]
        }, {
            title: "fab fa-accusoft",
            searchTerms: []
        }, {
            title: "fas fa-ad",
            searchTerms: []
        }, {
            title: "fas fa-address-book",
            searchTerms: []
        }, {
            title: "far fa-address-book",
            searchTerms: []
        }, {
            title: "fas fa-address-card",
            searchTerms: []
        }, {
            title: "far fa-address-card",
            searchTerms: []
        }, {
            title: "fas fa-adjust",
            searchTerms: [ "contrast" ]
        }, {
            title: "fab fa-adn",
            searchTerms: []
        }, {
            title: "fab fa-adversal",
            searchTerms: []
        }, {
            title: "fab fa-affiliatetheme",
            searchTerms: []
        }, {
            title: "fas fa-air-freshener",
            searchTerms: []
        }, {
            title: "fab fa-algolia",
            searchTerms: []
        }, {
            title: "fas fa-align-center",
            searchTerms: [ "middle", "text" ]
        }, {
            title: "fas fa-align-justify",
            searchTerms: [ "text" ]
        }, {
            title: "fas fa-align-left",
            searchTerms: [ "text" ]
        }, {
            title: "fas fa-align-right",
            searchTerms: [ "text" ]
        }, {
            title: "fab fa-alipay",
            searchTerms: []
        }, {
            title: "fas fa-allergies",
            searchTerms: [ "freckles", "hand", "intolerances", "pox", "spots" ]
        }, {
            title: "fab fa-amazon",
            searchTerms: []
        }, {
            title: "fab fa-amazon-pay",
            searchTerms: []
        }, {
            title: "fas fa-ambulance",
            searchTerms: [ "help", "machine", "support", "vehicle" ]
        }, {
            title: "fas fa-american-sign-language-interpreting",
            searchTerms: []
        }, {
            title: "fab fa-amilia",
            searchTerms: []
        }, {
            title: "fas fa-anchor",
            searchTerms: [ "link" ]
        }, {
            title: "fab fa-android",
            searchTerms: [ "robot" ]
        }, {
            title: "fab fa-angellist",
            searchTerms: []
        }, {
            title: "fas fa-angle-double-down",
            searchTerms: [ "arrows" ]
        }, {
            title: "fas fa-angle-double-left",
            searchTerms: [ "arrows", "back", "laquo", "previous", "quote" ]
        }, {
            title: "fas fa-angle-double-right",
            searchTerms: [ "arrows", "forward", "next", "quote", "raquo" ]
        }, {
            title: "fas fa-angle-double-up",
            searchTerms: [ "arrows" ]
        }, {
            title: "fas fa-angle-down",
            searchTerms: [ "arrow" ]
        }, {
            title: "fas fa-angle-left",
            searchTerms: [ "arrow", "back", "previous" ]
        }, {
            title: "fas fa-angle-right",
            searchTerms: [ "arrow", "forward", "next" ]
        }, {
            title: "fas fa-angle-up",
            searchTerms: [ "arrow" ]
        }, {
            title: "fas fa-angry",
            searchTerms: [ "disapprove", "emoticon", "face", "mad", "upset" ]
        }, {
            title: "far fa-angry",
            searchTerms: [ "disapprove", "emoticon", "face", "mad", "upset" ]
        }, {
            title: "fab fa-angrycreative",
            searchTerms: []
        }, {
            title: "fab fa-angular",
            searchTerms: []
        }, {
            title: "fas fa-ankh",
            searchTerms: [ "amulet", "copper", "coptic christianity", "copts", "crux ansata", "egyptian", "venus" ]
        }, {
            title: "fab fa-app-store",
            searchTerms: []
        }, {
            title: "fab fa-app-store-ios",
            searchTerms: []
        }, {
            title: "fab fa-apper",
            searchTerms: []
        }, {
            title: "fab fa-apple",
            searchTerms: [ "food", "fruit", "mac", "osx" ]
        }, {
            title: "fas fa-apple-alt",
            searchTerms: [ "fall", "food", "fruit", "fuji", "macintosh", "seasonal" ]
        }, {
            title: "fab fa-apple-pay",
            searchTerms: []
        }, {
            title: "fas fa-archive",
            searchTerms: [ "box", "package", "storage" ]
        }, {
            title: "fas fa-archway",
            searchTerms: [ "arc", "monument", "road", "street" ]
        }, {
            title: "fas fa-arrow-alt-circle-down",
            searchTerms: [ "arrow-circle-o-down", "download" ]
        }, {
            title: "far fa-arrow-alt-circle-down",
            searchTerms: [ "arrow-circle-o-down", "download" ]
        }, {
            title: "fas fa-arrow-alt-circle-left",
            searchTerms: [ "arrow-circle-o-left", "back", "previous" ]
        }, {
            title: "far fa-arrow-alt-circle-left",
            searchTerms: [ "arrow-circle-o-left", "back", "previous" ]
        }, {
            title: "fas fa-arrow-alt-circle-right",
            searchTerms: [ "arrow-circle-o-right", "forward", "next" ]
        }, {
            title: "far fa-arrow-alt-circle-right",
            searchTerms: [ "arrow-circle-o-right", "forward", "next" ]
        }, {
            title: "fas fa-arrow-alt-circle-up",
            searchTerms: [ "arrow-circle-o-up" ]
        }, {
            title: "far fa-arrow-alt-circle-up",
            searchTerms: [ "arrow-circle-o-up" ]
        }, {
            title: "fas fa-arrow-circle-down",
            searchTerms: [ "download" ]
        }, {
            title: "fas fa-arrow-circle-left",
            searchTerms: [ "back", "previous" ]
        }, {
            title: "fas fa-arrow-circle-right",
            searchTerms: [ "forward", "next" ]
        }, {
            title: "fas fa-arrow-circle-up",
            searchTerms: []
        }, {
            title: "fas fa-arrow-down",
            searchTerms: [ "download" ]
        }, {
            title: "fas fa-arrow-left",
            searchTerms: [ "back", "previous" ]
        }, {
            title: "fas fa-arrow-right",
            searchTerms: [ "forward", "next" ]
        }, {
            title: "fas fa-arrow-up",
            searchTerms: []
        }, {
            title: "fas fa-arrows-alt",
            searchTerms: [ "arrow", "arrows", "bigger", "enlarge", "expand", "fullscreen", "move", "position", "reorder", "resize" ]
        }, {
            title: "fas fa-arrows-alt-h",
            searchTerms: [ "arrows-h", "resize" ]
        }, {
            title: "fas fa-arrows-alt-v",
            searchTerms: [ "arrows-v", "resize" ]
        }, {
            title: "fas fa-assistive-listening-systems",
            searchTerms: []
        }, {
            title: "fas fa-asterisk",
            searchTerms: [ "details" ]
        }, {
            title: "fab fa-asymmetrik",
            searchTerms: []
        }, {
            title: "fas fa-at",
            searchTerms: [ "e-mail", "email" ]
        }, {
            title: "fas fa-atlas",
            searchTerms: [ "book", "directions", "geography", "map", "wayfinding" ]
        }, {
            title: "fas fa-atom",
            searchTerms: [ "atheism", "chemistry", "science" ]
        }, {
            title: "fab fa-audible",
            searchTerms: []
        }, {
            title: "fas fa-audio-description",
            searchTerms: []
        }, {
            title: "fab fa-autoprefixer",
            searchTerms: []
        }, {
            title: "fab fa-avianex",
            searchTerms: []
        }, {
            title: "fab fa-aviato",
            searchTerms: []
        }, {
            title: "fas fa-award",
            searchTerms: [ "honor", "praise", "prize", "recognition", "ribbon" ]
        }, {
            title: "fab fa-aws",
            searchTerms: []
        }, {
            title: "fas fa-backspace",
            searchTerms: [ "command", "delete", "keyboard", "undo" ]
        }, {
            title: "fas fa-backward",
            searchTerms: [ "previous", "rewind" ]
        }, {
            title: "fas fa-balance-scale",
            searchTerms: [ "balanced", "justice", "legal", "measure", "weight" ]
        }, {
            title: "fas fa-ban",
            searchTerms: [ "abort", "ban", "block", "cancel", "delete", "hide", "prohibit", "remove", "stop", "trash" ]
        }, {
            title: "fas fa-band-aid",
            searchTerms: [ "bandage", "boo boo", "ouch" ]
        }, {
            title: "fab fa-bandcamp",
            searchTerms: []
        }, {
            title: "fas fa-barcode",
            searchTerms: [ "scan" ]
        }, {
            title: "fas fa-bars",
            searchTerms: [ "checklist", "drag", "hamburger", "list", "menu", "nav", "navigation", "ol", "reorder", "settings", "todo", "ul" ]
        }, {
            title: "fas fa-baseball-ball",
            searchTerms: []
        }, {
            title: "fas fa-basketball-ball",
            searchTerms: []
        }, {
            title: "fas fa-bath",
            searchTerms: []
        }, {
            title: "fas fa-battery-empty",
            searchTerms: [ "power", "status" ]
        }, {
            title: "fas fa-battery-full",
            searchTerms: [ "power", "status" ]
        }, {
            title: "fas fa-battery-half",
            searchTerms: [ "power", "status" ]
        }, {
            title: "fas fa-battery-quarter",
            searchTerms: [ "power", "status" ]
        }, {
            title: "fas fa-battery-three-quarters",
            searchTerms: [ "power", "status" ]
        }, {
            title: "fas fa-bed",
            searchTerms: [ "lodging", "sleep", "travel" ]
        }, {
            title: "fas fa-beer",
            searchTerms: [ "alcohol", "bar", "beverage", "drink", "liquor", "mug", "stein" ]
        }, {
            title: "fab fa-behance",
            searchTerms: []
        }, {
            title: "fab fa-behance-square",
            searchTerms: []
        }, {
            title: "fas fa-bell",
            searchTerms: [ "alert", "notification", "reminder" ]
        }, {
            title: "far fa-bell",
            searchTerms: [ "alert", "notification", "reminder" ]
        }, {
            title: "fas fa-bell-slash",
            searchTerms: []
        }, {
            title: "far fa-bell-slash",
            searchTerms: []
        }, {
            title: "fas fa-bezier-curve",
            searchTerms: [ "curves", "illustrator", "lines", "path", "vector" ]
        }, {
            title: "fas fa-bible",
            searchTerms: [ "book", "catholicism", "christianity" ]
        }, {
            title: "fas fa-bicycle",
            searchTerms: [ "bike", "gears", "transportation", "vehicle" ]
        }, {
            title: "fab fa-bimobject",
            searchTerms: []
        }, {
            title: "fas fa-binoculars",
            searchTerms: []
        }, {
            title: "fas fa-birthday-cake",
            searchTerms: []
        }, {
            title: "fab fa-bitbucket",
            searchTerms: [ "bitbucket-square", "git" ]
        }, {
            title: "fab fa-bitcoin",
            searchTerms: []
        }, {
            title: "fab fa-bity",
            searchTerms: []
        }, {
            title: "fab fa-black-tie",
            searchTerms: []
        }, {
            title: "fab fa-blackberry",
            searchTerms: []
        }, {
            title: "fas fa-blender",
            searchTerms: []
        }, {
            title: "fas fa-blender-phone",
            searchTerms: [ "appliance", "fantasy", "silly" ]
        }, {
            title: "fas fa-blind",
            searchTerms: []
        }, {
            title: "fab fa-blogger",
            searchTerms: []
        }, {
            title: "fab fa-blogger-b",
            searchTerms: []
        }, {
            title: "fab fa-bluetooth",
            searchTerms: []
        }, {
            title: "fab fa-bluetooth-b",
            searchTerms: []
        }, {
            title: "fas fa-bold",
            searchTerms: []
        }, {
            title: "fas fa-bolt",
            searchTerms: [ "electricity", "lightning", "weather", "zap" ]
        }, {
            title: "fas fa-bomb",
            searchTerms: []
        }, {
            title: "fas fa-bone",
            searchTerms: []
        }, {
            title: "fas fa-bong",
            searchTerms: [ "aparatus", "cannabis", "marijuana", "pipe", "smoke", "smoking" ]
        }, {
            title: "fas fa-book",
            searchTerms: [ "documentation", "read" ]
        }, {
            title: "fas fa-book-dead",
            searchTerms: [ "Dungeons & Dragons", "crossbones", "d&d", "dark arts", "death", "dnd", "documentation", "evil", "fantasy", "halloween", "holiday", "read", "skull", "spell" ]
        }, {
            title: "fas fa-book-open",
            searchTerms: [ "flyer", "notebook", "open book", "pamphlet", "reading" ]
        }, {
            title: "fas fa-book-reader",
            searchTerms: [ "library" ]
        }, {
            title: "fas fa-bookmark",
            searchTerms: [ "save" ]
        }, {
            title: "far fa-bookmark",
            searchTerms: [ "save" ]
        }, {
            title: "fas fa-bowling-ball",
            searchTerms: []
        }, {
            title: "fas fa-box",
            searchTerms: [ "package" ]
        }, {
            title: "fas fa-box-open",
            searchTerms: []
        }, {
            title: "fas fa-boxes",
            searchTerms: []
        }, {
            title: "fas fa-braille",
            searchTerms: []
        }, {
            title: "fas fa-brain",
            searchTerms: [ "cerebellum", "gray matter", "intellect", "medulla oblongata", "mind", "noodle", "wit" ]
        }, {
            title: "fas fa-briefcase",
            searchTerms: [ "bag", "business", "luggage", "office", "work" ]
        }, {
            title: "fas fa-briefcase-medical",
            searchTerms: [ "health briefcase" ]
        }, {
            title: "fas fa-broadcast-tower",
            searchTerms: [ "airwaves", "radio", "waves" ]
        }, {
            title: "fas fa-broom",
            searchTerms: [ "clean", "firebolt", "fly", "halloween", "holiday", "nimbus 2000", "quidditch", "sweep", "witch" ]
        }, {
            title: "fas fa-brush",
            searchTerms: [ "bristles", "color", "handle", "painting" ]
        }, {
            title: "fab fa-btc",
            searchTerms: []
        }, {
            title: "fas fa-bug",
            searchTerms: [ "insect", "report" ]
        }, {
            title: "fas fa-building",
            searchTerms: [ "apartment", "business", "company", "office", "work" ]
        }, {
            title: "far fa-building",
            searchTerms: [ "apartment", "business", "company", "office", "work" ]
        }, {
            title: "fas fa-bullhorn",
            searchTerms: [ "announcement", "broadcast", "louder", "megaphone", "share" ]
        }, {
            title: "fas fa-bullseye",
            searchTerms: [ "target" ]
        }, {
            title: "fas fa-burn",
            searchTerms: [ "energy" ]
        }, {
            title: "fab fa-buromobelexperte",
            searchTerms: []
        }, {
            title: "fas fa-bus",
            searchTerms: [ "machine", "public transportation", "transportation", "vehicle" ]
        }, {
            title: "fas fa-bus-alt",
            searchTerms: [ "machine", "public transportation", "transportation", "vehicle" ]
        }, {
            title: "fas fa-business-time",
            searchTerms: [ "briefcase", "business socks", "clock", "flight of the conchords", "wednesday" ]
        }, {
            title: "fab fa-buysellads",
            searchTerms: []
        }, {
            title: "fas fa-calculator",
            searchTerms: []
        }, {
            title: "fas fa-calendar",
            searchTerms: [ "calendar-o", "date", "event", "schedule", "time", "when" ]
        }, {
            title: "far fa-calendar",
            searchTerms: [ "calendar-o", "date", "event", "schedule", "time", "when" ]
        }, {
            title: "fas fa-calendar-alt",
            searchTerms: [ "calendar", "date", "event", "schedule", "time", "when" ]
        }, {
            title: "far fa-calendar-alt",
            searchTerms: [ "calendar", "date", "event", "schedule", "time", "when" ]
        }, {
            title: "fas fa-calendar-check",
            searchTerms: [ "accept", "agree", "appointment", "confirm", "correct", "done", "ok", "select", "success", "todo" ]
        }, {
            title: "far fa-calendar-check",
            searchTerms: [ "accept", "agree", "appointment", "confirm", "correct", "done", "ok", "select", "success", "todo" ]
        }, {
            title: "fas fa-calendar-minus",
            searchTerms: [ "delete", "negative", "remove" ]
        }, {
            title: "far fa-calendar-minus",
            searchTerms: [ "delete", "negative", "remove" ]
        }, {
            title: "fas fa-calendar-plus",
            searchTerms: [ "add", "create", "new", "positive" ]
        }, {
            title: "far fa-calendar-plus",
            searchTerms: [ "add", "create", "new", "positive" ]
        }, {
            title: "fas fa-calendar-times",
            searchTerms: [ "archive", "delete", "remove", "x" ]
        }, {
            title: "far fa-calendar-times",
            searchTerms: [ "archive", "delete", "remove", "x" ]
        }, {
            title: "fas fa-camera",
            searchTerms: [ "photo", "picture", "record" ]
        }, {
            title: "fas fa-camera-retro",
            searchTerms: [ "photo", "picture", "record" ]
        }, {
            title: "fas fa-campground",
            searchTerms: [ "camping", "fall", "outdoors", "seasonal", "tent" ]
        }, {
            title: "fas fa-cannabis",
            searchTerms: [ "bud", "chronic", "drugs", "endica", "endo", "ganja", "marijuana", "mary jane", "pot", "reefer", "sativa", "spliff", "weed", "whacky-tabacky" ]
        }, {
            title: "fas fa-capsules",
            searchTerms: [ "drugs", "medicine" ]
        }, {
            title: "fas fa-car",
            searchTerms: [ "machine", "transportation", "vehicle" ]
        }, {
            title: "fas fa-car-alt",
            searchTerms: []
        }, {
            title: "fas fa-car-battery",
            searchTerms: []
        }, {
            title: "fas fa-car-crash",
            searchTerms: []
        }, {
            title: "fas fa-car-side",
            searchTerms: []
        }, {
            title: "fas fa-caret-down",
            searchTerms: [ "arrow", "dropdown", "menu", "more", "triangle down" ]
        }, {
            title: "fas fa-caret-left",
            searchTerms: [ "arrow", "back", "previous", "triangle left" ]
        }, {
            title: "fas fa-caret-right",
            searchTerms: [ "arrow", "forward", "next", "triangle right" ]
        }, {
            title: "fas fa-caret-square-down",
            searchTerms: [ "caret-square-o-down", "dropdown", "menu", "more" ]
        }, {
            title: "far fa-caret-square-down",
            searchTerms: [ "caret-square-o-down", "dropdown", "menu", "more" ]
        }, {
            title: "fas fa-caret-square-left",
            searchTerms: [ "back", "caret-square-o-left", "previous" ]
        }, {
            title: "far fa-caret-square-left",
            searchTerms: [ "back", "caret-square-o-left", "previous" ]
        }, {
            title: "fas fa-caret-square-right",
            searchTerms: [ "caret-square-o-right", "forward", "next" ]
        }, {
            title: "far fa-caret-square-right",
            searchTerms: [ "caret-square-o-right", "forward", "next" ]
        }, {
            title: "fas fa-caret-square-up",
            searchTerms: [ "caret-square-o-up" ]
        }, {
            title: "far fa-caret-square-up",
            searchTerms: [ "caret-square-o-up" ]
        }, {
            title: "fas fa-caret-up",
            searchTerms: [ "arrow", "triangle up" ]
        }, {
            title: "fas fa-cart-arrow-down",
            searchTerms: [ "shopping" ]
        }, {
            title: "fas fa-cart-plus",
            searchTerms: [ "add", "create", "new", "positive", "shopping" ]
        }, {
            title: "fas fa-cat",
            searchTerms: [ "feline", "halloween", "holiday", "kitten", "kitty", "meow", "pet" ]
        }, {
            title: "fab fa-cc-amazon-pay",
            searchTerms: []
        }, {
            title: "fab fa-cc-amex",
            searchTerms: [ "amex" ]
        }, {
            title: "fab fa-cc-apple-pay",
            searchTerms: []
        }, {
            title: "fab fa-cc-diners-club",
            searchTerms: []
        }, {
            title: "fab fa-cc-discover",
            searchTerms: []
        }, {
            title: "fab fa-cc-jcb",
            searchTerms: []
        }, {
            title: "fab fa-cc-mastercard",
            searchTerms: []
        }, {
            title: "fab fa-cc-paypal",
            searchTerms: []
        }, {
            title: "fab fa-cc-stripe",
            searchTerms: []
        }, {
            title: "fab fa-cc-visa",
            searchTerms: []
        }, {
            title: "fab fa-centercode",
            searchTerms: []
        }, {
            title: "fas fa-certificate",
            searchTerms: [ "badge", "star" ]
        }, {
            title: "fas fa-chair",
            searchTerms: [ "furniture", "seat" ]
        }, {
            title: "fas fa-chalkboard",
            searchTerms: [ "blackboard", "learning", "school", "teaching", "whiteboard", "writing" ]
        }, {
            title: "fas fa-chalkboard-teacher",
            searchTerms: [ "blackboard", "instructor", "learning", "professor", "school", "whiteboard", "writing" ]
        }, {
            title: "fas fa-charging-station",
            searchTerms: []
        }, {
            title: "fas fa-chart-area",
            searchTerms: [ "analytics", "area-chart", "graph" ]
        }, {
            title: "fas fa-chart-bar",
            searchTerms: [ "analytics", "bar-chart", "graph" ]
        }, {
            title: "far fa-chart-bar",
            searchTerms: [ "analytics", "bar-chart", "graph" ]
        }, {
            title: "fas fa-chart-line",
            searchTerms: [ "activity", "analytics", "dashboard", "graph", "line-chart" ]
        }, {
            title: "fas fa-chart-pie",
            searchTerms: [ "analytics", "graph", "pie-chart" ]
        }, {
            title: "fas fa-check",
            searchTerms: [ "accept", "agree", "checkmark", "confirm", "correct", "done", "notice", "notification", "notify", "ok", "select", "success", "tick", "todo", "yes" ]
        }, {
            title: "fas fa-check-circle",
            searchTerms: [ "accept", "agree", "confirm", "correct", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "far fa-check-circle",
            searchTerms: [ "accept", "agree", "confirm", "correct", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "fas fa-check-double",
            searchTerms: [ "accept", "agree", "checkmark", "confirm", "correct", "done", "notice", "notification", "notify", "ok", "select", "success", "tick", "todo" ]
        }, {
            title: "fas fa-check-square",
            searchTerms: [ "accept", "agree", "checkmark", "confirm", "correct", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "far fa-check-square",
            searchTerms: [ "accept", "agree", "checkmark", "confirm", "correct", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "fas fa-chess",
            searchTerms: []
        }, {
            title: "fas fa-chess-bishop",
            searchTerms: []
        }, {
            title: "fas fa-chess-board",
            searchTerms: []
        }, {
            title: "fas fa-chess-king",
            searchTerms: []
        }, {
            title: "fas fa-chess-knight",
            searchTerms: []
        }, {
            title: "fas fa-chess-pawn",
            searchTerms: []
        }, {
            title: "fas fa-chess-queen",
            searchTerms: []
        }, {
            title: "fas fa-chess-rook",
            searchTerms: []
        }, {
            title: "fas fa-chevron-circle-down",
            searchTerms: [ "arrow", "dropdown", "menu", "more" ]
        }, {
            title: "fas fa-chevron-circle-left",
            searchTerms: [ "arrow", "back", "previous" ]
        }, {
            title: "fas fa-chevron-circle-right",
            searchTerms: [ "arrow", "forward", "next" ]
        }, {
            title: "fas fa-chevron-circle-up",
            searchTerms: [ "arrow" ]
        }, {
            title: "fas fa-chevron-down",
            searchTerms: []
        }, {
            title: "fas fa-chevron-left",
            searchTerms: [ "back", "bracket", "previous" ]
        }, {
            title: "fas fa-chevron-right",
            searchTerms: [ "bracket", "forward", "next" ]
        }, {
            title: "fas fa-chevron-up",
            searchTerms: []
        }, {
            title: "fas fa-child",
            searchTerms: []
        }, {
            title: "fab fa-chrome",
            searchTerms: [ "browser" ]
        }, {
            title: "fas fa-church",
            searchTerms: [ "building", "community", "religion" ]
        }, {
            title: "fas fa-circle",
            searchTerms: [ "circle-thin", "dot", "notification" ]
        }, {
            title: "far fa-circle",
            searchTerms: [ "circle-thin", "dot", "notification" ]
        }, {
            title: "fas fa-circle-notch",
            searchTerms: [ "circle-o-notch" ]
        }, {
            title: "fas fa-city",
            searchTerms: [ "buildings", "busy", "skyscrapers", "urban", "windows" ]
        }, {
            title: "fas fa-clipboard",
            searchTerms: [ "paste" ]
        }, {
            title: "far fa-clipboard",
            searchTerms: [ "paste" ]
        }, {
            title: "fas fa-clipboard-check",
            searchTerms: [ "accept", "agree", "confirm", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "fas fa-clipboard-list",
            searchTerms: [ "checklist", "completed", "done", "finished", "intinerary", "ol", "schedule", "todo", "ul" ]
        }, {
            title: "fas fa-clock",
            searchTerms: [ "date", "late", "schedule", "timer", "timestamp", "watch" ]
        }, {
            title: "far fa-clock",
            searchTerms: [ "date", "late", "schedule", "timer", "timestamp", "watch" ]
        }, {
            title: "fas fa-clone",
            searchTerms: [ "copy", "duplicate" ]
        }, {
            title: "far fa-clone",
            searchTerms: [ "copy", "duplicate" ]
        }, {
            title: "fas fa-closed-captioning",
            searchTerms: [ "cc" ]
        }, {
            title: "far fa-closed-captioning",
            searchTerms: [ "cc" ]
        }, {
            title: "fas fa-cloud",
            searchTerms: [ "save" ]
        }, {
            title: "fas fa-cloud-download-alt",
            searchTerms: [ "import" ]
        }, {
            title: "fas fa-cloud-meatball",
            searchTerms: []
        }, {
            title: "fas fa-cloud-moon",
            searchTerms: [ "crescent", "evening", "halloween", "holiday", "lunar", "night", "sky" ]
        }, {
            title: "fas fa-cloud-moon-rain",
            searchTerms: []
        }, {
            title: "fas fa-cloud-rain",
            searchTerms: [ "precipitation" ]
        }, {
            title: "fas fa-cloud-showers-heavy",
            searchTerms: [ "precipitation", "rain", "storm" ]
        }, {
            title: "fas fa-cloud-sun",
            searchTerms: [ "day", "daytime", "fall", "outdoors", "seasonal" ]
        }, {
            title: "fas fa-cloud-sun-rain",
            searchTerms: []
        }, {
            title: "fas fa-cloud-upload-alt",
            searchTerms: [ "cloud-upload" ]
        }, {
            title: "fab fa-cloudscale",
            searchTerms: []
        }, {
            title: "fab fa-cloudsmith",
            searchTerms: []
        }, {
            title: "fab fa-cloudversify",
            searchTerms: []
        }, {
            title: "fas fa-cocktail",
            searchTerms: [ "alcohol", "beverage", "drink" ]
        }, {
            title: "fas fa-code",
            searchTerms: [ "brackets", "html" ]
        }, {
            title: "fas fa-code-branch",
            searchTerms: [ "branch", "code-fork", "fork", "git", "github", "rebase", "svn", "vcs", "version" ]
        }, {
            title: "fab fa-codepen",
            searchTerms: []
        }, {
            title: "fab fa-codiepie",
            searchTerms: []
        }, {
            title: "fas fa-coffee",
            searchTerms: [ "beverage", "breakfast", "cafe", "drink", "fall", "morning", "mug", "seasonal", "tea" ]
        }, {
            title: "fas fa-cog",
            searchTerms: [ "settings" ]
        }, {
            title: "fas fa-cogs",
            searchTerms: [ "gears", "settings" ]
        }, {
            title: "fas fa-coins",
            searchTerms: []
        }, {
            title: "fas fa-columns",
            searchTerms: [ "dashboard", "panes", "split" ]
        }, {
            title: "fas fa-comment",
            searchTerms: [ "bubble", "chat", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "far fa-comment",
            searchTerms: [ "bubble", "chat", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "fas fa-comment-alt",
            searchTerms: [ "bubble", "chat", "commenting", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "far fa-comment-alt",
            searchTerms: [ "bubble", "chat", "commenting", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "fas fa-comment-dollar",
            searchTerms: []
        }, {
            title: "fas fa-comment-dots",
            searchTerms: []
        }, {
            title: "far fa-comment-dots",
            searchTerms: []
        }, {
            title: "fas fa-comment-slash",
            searchTerms: []
        }, {
            title: "fas fa-comments",
            searchTerms: [ "bubble", "chat", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "far fa-comments",
            searchTerms: [ "bubble", "chat", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "fas fa-comments-dollar",
            searchTerms: []
        }, {
            title: "fas fa-compact-disc",
            searchTerms: [ "bluray", "cd", "disc", "media" ]
        }, {
            title: "fas fa-compass",
            searchTerms: [ "directory", "location", "menu", "safari" ]
        }, {
            title: "far fa-compass",
            searchTerms: [ "directory", "location", "menu", "safari" ]
        }, {
            title: "fas fa-compress",
            searchTerms: [ "collapse", "combine", "contract", "merge", "smaller" ]
        }, {
            title: "fas fa-concierge-bell",
            searchTerms: [ "attention", "hotel", "service", "support" ]
        }, {
            title: "fab fa-connectdevelop",
            searchTerms: []
        }, {
            title: "fab fa-contao",
            searchTerms: []
        }, {
            title: "fas fa-cookie",
            searchTerms: [ "baked good", "chips", "food", "snack", "sweet", "treat" ]
        }, {
            title: "fas fa-cookie-bite",
            searchTerms: [ "baked good", "bitten", "chips", "eating", "food", "snack", "sweet", "treat" ]
        }, {
            title: "fas fa-copy",
            searchTerms: [ "clone", "duplicate", "file", "files-o" ]
        }, {
            title: "far fa-copy",
            searchTerms: [ "clone", "duplicate", "file", "files-o" ]
        }, {
            title: "fas fa-copyright",
            searchTerms: []
        }, {
            title: "far fa-copyright",
            searchTerms: []
        }, {
            title: "fas fa-couch",
            searchTerms: [ "furniture", "sofa" ]
        }, {
            title: "fab fa-cpanel",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons-by",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons-nc",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons-nc-eu",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons-nc-jp",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons-nd",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons-pd",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons-pd-alt",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons-remix",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons-sa",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons-sampling",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons-sampling-plus",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons-share",
            searchTerms: []
        }, {
            title: "fab fa-creative-commons-zero",
            searchTerms: []
        }, {
            title: "fas fa-credit-card",
            searchTerms: [ "buy", "checkout", "credit-card-alt", "debit", "money", "payment", "purchase" ]
        }, {
            title: "far fa-credit-card",
            searchTerms: [ "buy", "checkout", "credit-card-alt", "debit", "money", "payment", "purchase" ]
        }, {
            title: "fab fa-critical-role",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "game", "gaming", "tabletop" ]
        }, {
            title: "fas fa-crop",
            searchTerms: [ "design" ]
        }, {
            title: "fas fa-crop-alt",
            searchTerms: []
        }, {
            title: "fas fa-cross",
            searchTerms: [ "catholicism", "christianity" ]
        }, {
            title: "fas fa-crosshairs",
            searchTerms: [ "gpd", "picker", "position" ]
        }, {
            title: "fas fa-crow",
            searchTerms: [ "bird", "bullfrog", "fauna", "halloween", "holiday", "toad" ]
        }, {
            title: "fas fa-crown",
            searchTerms: []
        }, {
            title: "fab fa-css3",
            searchTerms: [ "code" ]
        }, {
            title: "fab fa-css3-alt",
            searchTerms: []
        }, {
            title: "fas fa-cube",
            searchTerms: [ "package" ]
        }, {
            title: "fas fa-cubes",
            searchTerms: [ "packages" ]
        }, {
            title: "fas fa-cut",
            searchTerms: [ "scissors" ]
        }, {
            title: "fab fa-cuttlefish",
            searchTerms: []
        }, {
            title: "fab fa-d-and-d",
            searchTerms: []
        }, {
            title: "fab fa-d-and-d-beyond",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "gaming", "tabletop" ]
        }, {
            title: "fab fa-dashcube",
            searchTerms: []
        }, {
            title: "fas fa-database",
            searchTerms: []
        }, {
            title: "fas fa-deaf",
            searchTerms: []
        }, {
            title: "fab fa-delicious",
            searchTerms: []
        }, {
            title: "fas fa-democrat",
            searchTerms: [ "american", "democratic party", "donkey", "election", "left", "left-wing", "liberal", "politics", "usa" ]
        }, {
            title: "fab fa-deploydog",
            searchTerms: []
        }, {
            title: "fab fa-deskpro",
            searchTerms: []
        }, {
            title: "fas fa-desktop",
            searchTerms: [ "computer", "cpu", "demo", "desktop", "device", "machine", "monitor", "pc", "screen" ]
        }, {
            title: "fab fa-dev",
            searchTerms: []
        }, {
            title: "fab fa-deviantart",
            searchTerms: []
        }, {
            title: "fas fa-dharmachakra",
            searchTerms: [ "buddhism", "buddhist", "wheel of dharma" ]
        }, {
            title: "fas fa-diagnoses",
            searchTerms: []
        }, {
            title: "fas fa-dice",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-d20",
            searchTerms: [ "Dungeons & Dragons", "chance", "d&d", "dnd", "fantasy", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-d6",
            searchTerms: [ "Dungeons & Dragons", "chance", "d&d", "dnd", "fantasy", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-five",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-four",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-one",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-six",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-three",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fas fa-dice-two",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "fab fa-digg",
            searchTerms: []
        }, {
            title: "fab fa-digital-ocean",
            searchTerms: []
        }, {
            title: "fas fa-digital-tachograph",
            searchTerms: []
        }, {
            title: "fas fa-directions",
            searchTerms: []
        }, {
            title: "fab fa-discord",
            searchTerms: []
        }, {
            title: "fab fa-discourse",
            searchTerms: []
        }, {
            title: "fas fa-divide",
            searchTerms: []
        }, {
            title: "fas fa-dizzy",
            searchTerms: [ "dazed", "disapprove", "emoticon", "face" ]
        }, {
            title: "far fa-dizzy",
            searchTerms: [ "dazed", "disapprove", "emoticon", "face" ]
        }, {
            title: "fas fa-dna",
            searchTerms: [ "double helix", "helix" ]
        }, {
            title: "fab fa-dochub",
            searchTerms: []
        }, {
            title: "fab fa-docker",
            searchTerms: []
        }, {
            title: "fas fa-dog",
            searchTerms: [ "canine", "fauna", "mammmal", "pet", "pooch", "puppy", "woof" ]
        }, {
            title: "fas fa-dollar-sign",
            searchTerms: [ "$", "dollar-sign", "money", "price", "usd" ]
        }, {
            title: "fas fa-dolly",
            searchTerms: []
        }, {
            title: "fas fa-dolly-flatbed",
            searchTerms: []
        }, {
            title: "fas fa-donate",
            searchTerms: [ "generosity", "give" ]
        }, {
            title: "fas fa-door-closed",
            searchTerms: []
        }, {
            title: "fas fa-door-open",
            searchTerms: []
        }, {
            title: "fas fa-dot-circle",
            searchTerms: [ "bullseye", "notification", "target" ]
        }, {
            title: "far fa-dot-circle",
            searchTerms: [ "bullseye", "notification", "target" ]
        }, {
            title: "fas fa-dove",
            searchTerms: [ "bird", "fauna", "flying", "peace" ]
        }, {
            title: "fas fa-download",
            searchTerms: [ "import" ]
        }, {
            title: "fab fa-draft2digital",
            searchTerms: []
        }, {
            title: "fas fa-drafting-compass",
            searchTerms: [ "mechanical drawing", "plot", "plotting" ]
        }, {
            title: "fas fa-dragon",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy" ]
        }, {
            title: "fas fa-draw-polygon",
            searchTerms: []
        }, {
            title: "fab fa-dribbble",
            searchTerms: []
        }, {
            title: "fab fa-dribbble-square",
            searchTerms: []
        }, {
            title: "fab fa-dropbox",
            searchTerms: []
        }, {
            title: "fas fa-drum",
            searchTerms: [ "instrument", "music", "percussion", "snare", "sound" ]
        }, {
            title: "fas fa-drum-steelpan",
            searchTerms: [ "calypso", "instrument", "music", "percussion", "reggae", "snare", "sound", "steel", "tropical" ]
        }, {
            title: "fas fa-drumstick-bite",
            searchTerms: []
        }, {
            title: "fab fa-drupal",
            searchTerms: []
        }, {
            title: "fas fa-dumbbell",
            searchTerms: [ "exercise", "gym", "strength", "weight", "weight-lifting" ]
        }, {
            title: "fas fa-dungeon",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "door", "entrance", "fantasy", "gate" ]
        }, {
            title: "fab fa-dyalog",
            searchTerms: []
        }, {
            title: "fab fa-earlybirds",
            searchTerms: []
        }, {
            title: "fab fa-ebay",
            searchTerms: []
        }, {
            title: "fab fa-edge",
            searchTerms: [ "browser", "ie" ]
        }, {
            title: "fas fa-edit",
            searchTerms: [ "edit", "pen", "pencil", "update", "write" ]
        }, {
            title: "far fa-edit",
            searchTerms: [ "edit", "pen", "pencil", "update", "write" ]
        }, {
            title: "fas fa-eject",
            searchTerms: []
        }, {
            title: "fab fa-elementor",
            searchTerms: []
        }, {
            title: "fas fa-ellipsis-h",
            searchTerms: [ "dots", "drag", "kebab", "list", "menu", "nav", "navigation", "ol", "reorder", "settings", "ul" ]
        }, {
            title: "fas fa-ellipsis-v",
            searchTerms: [ "dots", "drag", "kebab", "list", "menu", "nav", "navigation", "ol", "reorder", "settings", "ul" ]
        }, {
            title: "fab fa-ello",
            searchTerms: []
        }, {
            title: "fab fa-ember",
            searchTerms: []
        }, {
            title: "fab fa-empire",
            searchTerms: []
        }, {
            title: "fas fa-envelope",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support" ]
        }, {
            title: "far fa-envelope",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support" ]
        }, {
            title: "fas fa-envelope-open",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support" ]
        }, {
            title: "far fa-envelope-open",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support" ]
        }, {
            title: "fas fa-envelope-open-text",
            searchTerms: []
        }, {
            title: "fas fa-envelope-square",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support" ]
        }, {
            title: "fab fa-envira",
            searchTerms: [ "leaf" ]
        }, {
            title: "fas fa-equals",
            searchTerms: []
        }, {
            title: "fas fa-eraser",
            searchTerms: [ "delete", "remove" ]
        }, {
            title: "fab fa-erlang",
            searchTerms: []
        }, {
            title: "fab fa-ethereum",
            searchTerms: []
        }, {
            title: "fab fa-etsy",
            searchTerms: []
        }, {
            title: "fas fa-euro-sign",
            searchTerms: [ "eur" ]
        }, {
            title: "fas fa-exchange-alt",
            searchTerms: [ "arrow", "arrows", "exchange", "reciprocate", "return", "swap", "transfer" ]
        }, {
            title: "fas fa-exclamation",
            searchTerms: [ "alert", "danger", "error", "important", "notice", "notification", "notify", "problem", "warning" ]
        }, {
            title: "fas fa-exclamation-circle",
            searchTerms: [ "alert", "danger", "error", "important", "notice", "notification", "notify", "problem", "warning" ]
        }, {
            title: "fas fa-exclamation-triangle",
            searchTerms: [ "alert", "danger", "error", "important", "notice", "notification", "notify", "problem", "warning" ]
        }, {
            title: "fas fa-expand",
            searchTerms: [ "bigger", "enlarge", "resize" ]
        }, {
            title: "fas fa-expand-arrows-alt",
            searchTerms: [ "arrows-alt", "bigger", "enlarge", "move", "resize" ]
        }, {
            title: "fab fa-expeditedssl",
            searchTerms: []
        }, {
            title: "fas fa-external-link-alt",
            searchTerms: [ "external-link", "new", "open" ]
        }, {
            title: "fas fa-external-link-square-alt",
            searchTerms: [ "external-link-square", "new", "open" ]
        }, {
            title: "fas fa-eye",
            searchTerms: [ "optic", "see", "seen", "show", "sight", "views", "visible" ]
        }, {
            title: "far fa-eye",
            searchTerms: [ "optic", "see", "seen", "show", "sight", "views", "visible" ]
        }, {
            title: "fas fa-eye-dropper",
            searchTerms: [ "eyedropper" ]
        }, {
            title: "fas fa-eye-slash",
            searchTerms: [ "blind", "hide", "show", "toggle", "unseen", "views", "visible", "visiblity" ]
        }, {
            title: "far fa-eye-slash",
            searchTerms: [ "blind", "hide", "show", "toggle", "unseen", "views", "visible", "visiblity" ]
        }, {
            title: "fab fa-facebook",
            searchTerms: [ "facebook-official", "social network" ]
        }, {
            title: "fab fa-facebook-f",
            searchTerms: [ "facebook" ]
        }, {
            title: "fab fa-facebook-messenger",
            searchTerms: []
        }, {
            title: "fab fa-facebook-square",
            searchTerms: [ "social network" ]
        }, {
            title: "fab fa-fantasy-flight-games",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "game", "gaming", "tabletop" ]
        }, {
            title: "fas fa-fast-backward",
            searchTerms: [ "beginning", "first", "previous", "rewind", "start" ]
        }, {
            title: "fas fa-fast-forward",
            searchTerms: [ "end", "last", "next" ]
        }, {
            title: "fas fa-fax",
            searchTerms: []
        }, {
            title: "fas fa-feather",
            searchTerms: [ "bird", "light", "plucked", "quill" ]
        }, {
            title: "fas fa-feather-alt",
            searchTerms: [ "bird", "light", "plucked", "quill" ]
        }, {
            title: "fas fa-female",
            searchTerms: [ "human", "person", "profile", "user", "woman" ]
        }, {
            title: "fas fa-fighter-jet",
            searchTerms: [ "airplane", "fast", "fly", "goose", "maverick", "plane", "quick", "top gun", "transportation", "travel" ]
        }, {
            title: "fas fa-file",
            searchTerms: [ "document", "new", "page", "pdf", "resume" ]
        }, {
            title: "far fa-file",
            searchTerms: [ "document", "new", "page", "pdf", "resume" ]
        }, {
            title: "fas fa-file-alt",
            searchTerms: [ "document", "file-text", "invoice", "new", "page", "pdf" ]
        }, {
            title: "far fa-file-alt",
            searchTerms: [ "document", "file-text", "invoice", "new", "page", "pdf" ]
        }, {
            title: "fas fa-file-archive",
            searchTerms: [ ".zip", "bundle", "compress", "compression", "download", "zip" ]
        }, {
            title: "far fa-file-archive",
            searchTerms: [ ".zip", "bundle", "compress", "compression", "download", "zip" ]
        }, {
            title: "fas fa-file-audio",
            searchTerms: []
        }, {
            title: "far fa-file-audio",
            searchTerms: []
        }, {
            title: "fas fa-file-code",
            searchTerms: []
        }, {
            title: "far fa-file-code",
            searchTerms: []
        }, {
            title: "fas fa-file-contract",
            searchTerms: [ "agreement", "binding", "document", "legal", "signature" ]
        }, {
            title: "fas fa-file-csv",
            searchTerms: [ "spreadsheets" ]
        }, {
            title: "fas fa-file-download",
            searchTerms: []
        }, {
            title: "fas fa-file-excel",
            searchTerms: []
        }, {
            title: "far fa-file-excel",
            searchTerms: []
        }, {
            title: "fas fa-file-export",
            searchTerms: []
        }, {
            title: "fas fa-file-image",
            searchTerms: []
        }, {
            title: "far fa-file-image",
            searchTerms: []
        }, {
            title: "fas fa-file-import",
            searchTerms: []
        }, {
            title: "fas fa-file-invoice",
            searchTerms: [ "bill", "document", "receipt" ]
        }, {
            title: "fas fa-file-invoice-dollar",
            searchTerms: [ "$", "bill", "document", "dollar-sign", "money", "receipt", "usd" ]
        }, {
            title: "fas fa-file-medical",
            searchTerms: []
        }, {
            title: "fas fa-file-medical-alt",
            searchTerms: []
        }, {
            title: "fas fa-file-pdf",
            searchTerms: []
        }, {
            title: "far fa-file-pdf",
            searchTerms: []
        }, {
            title: "fas fa-file-powerpoint",
            searchTerms: []
        }, {
            title: "far fa-file-powerpoint",
            searchTerms: []
        }, {
            title: "fas fa-file-prescription",
            searchTerms: [ "drugs", "medical", "medicine", "rx" ]
        }, {
            title: "fas fa-file-signature",
            searchTerms: [ "John Hancock", "contract", "document", "name" ]
        }, {
            title: "fas fa-file-upload",
            searchTerms: []
        }, {
            title: "fas fa-file-video",
            searchTerms: []
        }, {
            title: "far fa-file-video",
            searchTerms: []
        }, {
            title: "fas fa-file-word",
            searchTerms: []
        }, {
            title: "far fa-file-word",
            searchTerms: []
        }, {
            title: "fas fa-fill",
            searchTerms: [ "bucket", "color", "paint", "paint bucket" ]
        }, {
            title: "fas fa-fill-drip",
            searchTerms: [ "bucket", "color", "drop", "paint", "paint bucket", "spill" ]
        }, {
            title: "fas fa-film",
            searchTerms: [ "movie" ]
        }, {
            title: "fas fa-filter",
            searchTerms: [ "funnel", "options" ]
        }, {
            title: "fas fa-fingerprint",
            searchTerms: [ "human", "id", "identification", "lock", "smudge", "touch", "unique", "unlock" ]
        }, {
            title: "fas fa-fire",
            searchTerms: [ "caliente", "flame", "heat", "hot", "popular" ]
        }, {
            title: "fas fa-fire-extinguisher",
            searchTerms: []
        }, {
            title: "fab fa-firefox",
            searchTerms: [ "browser" ]
        }, {
            title: "fas fa-first-aid",
            searchTerms: []
        }, {
            title: "fab fa-first-order",
            searchTerms: []
        }, {
            title: "fab fa-first-order-alt",
            searchTerms: []
        }, {
            title: "fab fa-firstdraft",
            searchTerms: []
        }, {
            title: "fas fa-fish",
            searchTerms: [ "fauna", "gold", "swimming" ]
        }, {
            title: "fas fa-fist-raised",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "hand", "ki", "monk", "resist", "strength", "unarmed combat" ]
        }, {
            title: "fas fa-flag",
            searchTerms: [ "country", "notice", "notification", "notify", "pole", "report", "symbol" ]
        }, {
            title: "far fa-flag",
            searchTerms: [ "country", "notice", "notification", "notify", "pole", "report", "symbol" ]
        }, {
            title: "fas fa-flag-checkered",
            searchTerms: [ "notice", "notification", "notify", "pole", "racing", "report", "symbol" ]
        }, {
            title: "fas fa-flag-usa",
            searchTerms: [ "betsy ross", "country", "old glory", "stars", "stripes", "symbol" ]
        }, {
            title: "fas fa-flask",
            searchTerms: [ "beaker", "experimental", "labs", "science" ]
        }, {
            title: "fab fa-flickr",
            searchTerms: []
        }, {
            title: "fab fa-flipboard",
            searchTerms: []
        }, {
            title: "fas fa-flushed",
            searchTerms: [ "embarrassed", "emoticon", "face" ]
        }, {
            title: "far fa-flushed",
            searchTerms: [ "embarrassed", "emoticon", "face" ]
        }, {
            title: "fab fa-fly",
            searchTerms: []
        }, {
            title: "fas fa-folder",
            searchTerms: []
        }, {
            title: "far fa-folder",
            searchTerms: []
        }, {
            title: "fas fa-folder-minus",
            searchTerms: [ "archive", "delete", "negative", "remove" ]
        }, {
            title: "fas fa-folder-open",
            searchTerms: []
        }, {
            title: "far fa-folder-open",
            searchTerms: []
        }, {
            title: "fas fa-folder-plus",
            searchTerms: [ "add", "create", "new", "positive" ]
        }, {
            title: "fas fa-font",
            searchTerms: [ "text" ]
        }, {
            title: "fab fa-font-awesome",
            searchTerms: [ "meanpath" ]
        }, {
            title: "fab fa-font-awesome-alt",
            searchTerms: []
        }, {
            title: "fab fa-font-awesome-flag",
            searchTerms: []
        }, {
            title: "far fa-font-awesome-logo-full",
            searchTerms: []
        }, {
            title: "fas fa-font-awesome-logo-full",
            searchTerms: []
        }, {
            title: "fab fa-font-awesome-logo-full",
            searchTerms: []
        }, {
            title: "fab fa-fonticons",
            searchTerms: []
        }, {
            title: "fab fa-fonticons-fi",
            searchTerms: []
        }, {
            title: "fas fa-football-ball",
            searchTerms: [ "fall", "pigskin", "seasonal" ]
        }, {
            title: "fab fa-fort-awesome",
            searchTerms: [ "castle" ]
        }, {
            title: "fab fa-fort-awesome-alt",
            searchTerms: [ "castle" ]
        }, {
            title: "fab fa-forumbee",
            searchTerms: []
        }, {
            title: "fas fa-forward",
            searchTerms: [ "forward", "next" ]
        }, {
            title: "fab fa-foursquare",
            searchTerms: []
        }, {
            title: "fab fa-free-code-camp",
            searchTerms: []
        }, {
            title: "fab fa-freebsd",
            searchTerms: []
        }, {
            title: "fas fa-frog",
            searchTerms: [ "amphibian", "bullfrog", "fauna", "hop", "kermit", "kiss", "prince", "ribbit", "toad", "wart" ]
        }, {
            title: "fas fa-frown",
            searchTerms: [ "disapprove", "emoticon", "face", "rating", "sad" ]
        }, {
            title: "far fa-frown",
            searchTerms: [ "disapprove", "emoticon", "face", "rating", "sad" ]
        }, {
            title: "fas fa-frown-open",
            searchTerms: [ "disapprove", "emoticon", "face", "rating", "sad" ]
        }, {
            title: "far fa-frown-open",
            searchTerms: [ "disapprove", "emoticon", "face", "rating", "sad" ]
        }, {
            title: "fab fa-fulcrum",
            searchTerms: []
        }, {
            title: "fas fa-funnel-dollar",
            searchTerms: []
        }, {
            title: "fas fa-futbol",
            searchTerms: [ "ball", "football", "soccer" ]
        }, {
            title: "far fa-futbol",
            searchTerms: [ "ball", "football", "soccer" ]
        }, {
            title: "fab fa-galactic-republic",
            searchTerms: [ "politics", "star wars" ]
        }, {
            title: "fab fa-galactic-senate",
            searchTerms: [ "star wars" ]
        }, {
            title: "fas fa-gamepad",
            searchTerms: [ "controller" ]
        }, {
            title: "fas fa-gas-pump",
            searchTerms: []
        }, {
            title: "fas fa-gavel",
            searchTerms: [ "hammer", "judge", "lawyer", "opinion" ]
        }, {
            title: "fas fa-gem",
            searchTerms: [ "diamond" ]
        }, {
            title: "far fa-gem",
            searchTerms: [ "diamond" ]
        }, {
            title: "fas fa-genderless",
            searchTerms: []
        }, {
            title: "fab fa-get-pocket",
            searchTerms: []
        }, {
            title: "fab fa-gg",
            searchTerms: []
        }, {
            title: "fab fa-gg-circle",
            searchTerms: []
        }, {
            title: "fas fa-ghost",
            searchTerms: [ "apparition", "blinky", "clyde", "floating", "halloween", "holiday", "inky", "pinky", "spirit" ]
        }, {
            title: "fas fa-gift",
            searchTerms: [ "generosity", "giving", "party", "present", "wrapped" ]
        }, {
            title: "fab fa-git",
            searchTerms: []
        }, {
            title: "fab fa-git-square",
            searchTerms: []
        }, {
            title: "fab fa-github",
            searchTerms: [ "octocat" ]
        }, {
            title: "fab fa-github-alt",
            searchTerms: [ "octocat" ]
        }, {
            title: "fab fa-github-square",
            searchTerms: [ "octocat" ]
        }, {
            title: "fab fa-gitkraken",
            searchTerms: []
        }, {
            title: "fab fa-gitlab",
            searchTerms: [ "Axosoft" ]
        }, {
            title: "fab fa-gitter",
            searchTerms: []
        }, {
            title: "fas fa-glass-martini",
            searchTerms: [ "alcohol", "bar", "beverage", "drink", "glass", "liquor", "martini" ]
        }, {
            title: "fas fa-glass-martini-alt",
            searchTerms: []
        }, {
            title: "fas fa-glasses",
            searchTerms: [ "foureyes", "hipster", "nerd", "reading", "sight", "spectacles" ]
        }, {
            title: "fab fa-glide",
            searchTerms: []
        }, {
            title: "fab fa-glide-g",
            searchTerms: []
        }, {
            title: "fas fa-globe",
            searchTerms: [ "all", "coordinates", "country", "earth", "global", "gps", "language", "localize", "location", "map", "online", "place", "planet", "translate", "travel", "world" ]
        }, {
            title: "fas fa-globe-africa",
            searchTerms: [ "all", "country", "earth", "global", "gps", "language", "localize", "location", "map", "online", "place", "planet", "translate", "travel", "world" ]
        }, {
            title: "fas fa-globe-americas",
            searchTerms: [ "all", "country", "earth", "global", "gps", "language", "localize", "location", "map", "online", "place", "planet", "translate", "travel", "world" ]
        }, {
            title: "fas fa-globe-asia",
            searchTerms: [ "all", "country", "earth", "global", "gps", "language", "localize", "location", "map", "online", "place", "planet", "translate", "travel", "world" ]
        }, {
            title: "fab fa-gofore",
            searchTerms: []
        }, {
            title: "fas fa-golf-ball",
            searchTerms: []
        }, {
            title: "fab fa-goodreads",
            searchTerms: []
        }, {
            title: "fab fa-goodreads-g",
            searchTerms: []
        }, {
            title: "fab fa-google",
            searchTerms: []
        }, {
            title: "fab fa-google-drive",
            searchTerms: []
        }, {
            title: "fab fa-google-play",
            searchTerms: []
        }, {
            title: "fab fa-google-plus",
            searchTerms: [ "google-plus-circle", "google-plus-official" ]
        }, {
            title: "fab fa-google-plus-g",
            searchTerms: [ "google-plus", "social network" ]
        }, {
            title: "fab fa-google-plus-square",
            searchTerms: [ "social network" ]
        }, {
            title: "fab fa-google-wallet",
            searchTerms: []
        }, {
            title: "fas fa-gopuram",
            searchTerms: [ "building", "entrance", "hinduism", "temple", "tower" ]
        }, {
            title: "fas fa-graduation-cap",
            searchTerms: [ "learning", "school", "student" ]
        }, {
            title: "fab fa-gratipay",
            searchTerms: [ "favorite", "heart", "like", "love" ]
        }, {
            title: "fab fa-grav",
            searchTerms: []
        }, {
            title: "fas fa-greater-than",
            searchTerms: []
        }, {
            title: "fas fa-greater-than-equal",
            searchTerms: []
        }, {
            title: "fas fa-grimace",
            searchTerms: [ "cringe", "emoticon", "face" ]
        }, {
            title: "far fa-grimace",
            searchTerms: [ "cringe", "emoticon", "face" ]
        }, {
            title: "fas fa-grin",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "far fa-grin",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "fas fa-grin-alt",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "far fa-grin-alt",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "fas fa-grin-beam",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "far fa-grin-beam",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "fas fa-grin-beam-sweat",
            searchTerms: [ "emoticon", "face", "smile" ]
        }, {
            title: "far fa-grin-beam-sweat",
            searchTerms: [ "emoticon", "face", "smile" ]
        }, {
            title: "fas fa-grin-hearts",
            searchTerms: [ "emoticon", "face", "love", "smile" ]
        }, {
            title: "far fa-grin-hearts",
            searchTerms: [ "emoticon", "face", "love", "smile" ]
        }, {
            title: "fas fa-grin-squint",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "far fa-grin-squint",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "fas fa-grin-squint-tears",
            searchTerms: [ "emoticon", "face", "happy", "smile" ]
        }, {
            title: "far fa-grin-squint-tears",
            searchTerms: [ "emoticon", "face", "happy", "smile" ]
        }, {
            title: "fas fa-grin-stars",
            searchTerms: [ "emoticon", "face", "star-struck" ]
        }, {
            title: "far fa-grin-stars",
            searchTerms: [ "emoticon", "face", "star-struck" ]
        }, {
            title: "fas fa-grin-tears",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-grin-tears",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-grin-tongue",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-grin-tongue",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-grin-tongue-squint",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-grin-tongue-squint",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-grin-tongue-wink",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-grin-tongue-wink",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-grin-wink",
            searchTerms: [ "emoticon", "face", "flirt", "laugh", "smile" ]
        }, {
            title: "far fa-grin-wink",
            searchTerms: [ "emoticon", "face", "flirt", "laugh", "smile" ]
        }, {
            title: "fas fa-grip-horizontal",
            searchTerms: [ "affordance", "drag", "drop", "grab", "handle" ]
        }, {
            title: "fas fa-grip-vertical",
            searchTerms: [ "affordance", "drag", "drop", "grab", "handle" ]
        }, {
            title: "fab fa-gripfire",
            searchTerms: []
        }, {
            title: "fab fa-grunt",
            searchTerms: []
        }, {
            title: "fab fa-gulp",
            searchTerms: []
        }, {
            title: "fas fa-h-square",
            searchTerms: [ "hospital", "hotel" ]
        }, {
            title: "fab fa-hacker-news",
            searchTerms: []
        }, {
            title: "fab fa-hacker-news-square",
            searchTerms: []
        }, {
            title: "fab fa-hackerrank",
            searchTerms: []
        }, {
            title: "fas fa-hammer",
            searchTerms: [ "admin", "fix", "repair", "settings", "tool" ]
        }, {
            title: "fas fa-hamsa",
            searchTerms: [ "amulet", "christianity", "islam", "jewish", "judaism", "muslim", "protection" ]
        }, {
            title: "fas fa-hand-holding",
            searchTerms: []
        }, {
            title: "fas fa-hand-holding-heart",
            searchTerms: []
        }, {
            title: "fas fa-hand-holding-usd",
            searchTerms: [ "$", "dollar sign", "donation", "giving", "money", "price" ]
        }, {
            title: "fas fa-hand-lizard",
            searchTerms: []
        }, {
            title: "far fa-hand-lizard",
            searchTerms: []
        }, {
            title: "fas fa-hand-paper",
            searchTerms: [ "stop" ]
        }, {
            title: "far fa-hand-paper",
            searchTerms: [ "stop" ]
        }, {
            title: "fas fa-hand-peace",
            searchTerms: []
        }, {
            title: "far fa-hand-peace",
            searchTerms: []
        }, {
            title: "fas fa-hand-point-down",
            searchTerms: [ "finger", "hand-o-down", "point" ]
        }, {
            title: "far fa-hand-point-down",
            searchTerms: [ "finger", "hand-o-down", "point" ]
        }, {
            title: "fas fa-hand-point-left",
            searchTerms: [ "back", "finger", "hand-o-left", "left", "point", "previous" ]
        }, {
            title: "far fa-hand-point-left",
            searchTerms: [ "back", "finger", "hand-o-left", "left", "point", "previous" ]
        }, {
            title: "fas fa-hand-point-right",
            searchTerms: [ "finger", "forward", "hand-o-right", "next", "point", "right" ]
        }, {
            title: "far fa-hand-point-right",
            searchTerms: [ "finger", "forward", "hand-o-right", "next", "point", "right" ]
        }, {
            title: "fas fa-hand-point-up",
            searchTerms: [ "finger", "hand-o-up", "point" ]
        }, {
            title: "far fa-hand-point-up",
            searchTerms: [ "finger", "hand-o-up", "point" ]
        }, {
            title: "fas fa-hand-pointer",
            searchTerms: [ "select" ]
        }, {
            title: "far fa-hand-pointer",
            searchTerms: [ "select" ]
        }, {
            title: "fas fa-hand-rock",
            searchTerms: []
        }, {
            title: "far fa-hand-rock",
            searchTerms: []
        }, {
            title: "fas fa-hand-scissors",
            searchTerms: []
        }, {
            title: "far fa-hand-scissors",
            searchTerms: []
        }, {
            title: "fas fa-hand-spock",
            searchTerms: []
        }, {
            title: "far fa-hand-spock",
            searchTerms: []
        }, {
            title: "fas fa-hands",
            searchTerms: []
        }, {
            title: "fas fa-hands-helping",
            searchTerms: [ "aid", "assistance", "partnership", "volunteering" ]
        }, {
            title: "fas fa-handshake",
            searchTerms: [ "greeting", "partnership" ]
        }, {
            title: "far fa-handshake",
            searchTerms: [ "greeting", "partnership" ]
        }, {
            title: "fas fa-hanukiah",
            searchTerms: [ "candle", "hanukkah", "jewish", "judaism", "light" ]
        }, {
            title: "fas fa-hashtag",
            searchTerms: []
        }, {
            title: "fas fa-hat-wizard",
            searchTerms: [ "Dungeons & Dragons", "buckle", "cloth", "clothing", "d&d", "dnd", "fantasy", "halloween", "holiday", "mage", "magic", "pointy", "witch" ]
        }, {
            title: "fas fa-haykal",
            searchTerms: [ "bahai", "bahá'í", "star" ]
        }, {
            title: "fas fa-hdd",
            searchTerms: [ "cpu", "hard drive", "harddrive", "machine", "save", "storage" ]
        }, {
            title: "far fa-hdd",
            searchTerms: [ "cpu", "hard drive", "harddrive", "machine", "save", "storage" ]
        }, {
            title: "fas fa-heading",
            searchTerms: [ "header" ]
        }, {
            title: "fas fa-headphones",
            searchTerms: [ "audio", "listen", "music", "sound", "speaker" ]
        }, {
            title: "fas fa-headphones-alt",
            searchTerms: [ "audio", "listen", "music", "sound", "speaker" ]
        }, {
            title: "fas fa-headset",
            searchTerms: [ "audio", "gamer", "gaming", "listen", "live chat", "microphone", "shot caller", "sound", "support", "telemarketer" ]
        }, {
            title: "fas fa-heart",
            searchTerms: [ "favorite", "like", "love" ]
        }, {
            title: "far fa-heart",
            searchTerms: [ "favorite", "like", "love" ]
        }, {
            title: "fas fa-heartbeat",
            searchTerms: [ "ekg", "lifeline", "vital signs" ]
        }, {
            title: "fas fa-helicopter",
            searchTerms: [ "airwolf", "apache", "chopper", "flight", "fly" ]
        }, {
            title: "fas fa-highlighter",
            searchTerms: [ "edit", "marker", "sharpie", "update", "write" ]
        }, {
            title: "fas fa-hiking",
            searchTerms: [ "activity", "backpack", "fall", "fitness", "outdoors", "seasonal", "walking" ]
        }, {
            title: "fas fa-hippo",
            searchTerms: [ "fauna", "hungry", "mammmal" ]
        }, {
            title: "fab fa-hips",
            searchTerms: []
        }, {
            title: "fab fa-hire-a-helper",
            searchTerms: []
        }, {
            title: "fas fa-history",
            searchTerms: []
        }, {
            title: "fas fa-hockey-puck",
            searchTerms: []
        }, {
            title: "fas fa-home",
            searchTerms: [ "house", "main" ]
        }, {
            title: "fab fa-hooli",
            searchTerms: []
        }, {
            title: "fab fa-hornbill",
            searchTerms: []
        }, {
            title: "fas fa-horse",
            searchTerms: [ "equus", "fauna", "mammmal", "neigh" ]
        }, {
            title: "fas fa-hospital",
            searchTerms: [ "building", "emergency room", "medical center" ]
        }, {
            title: "far fa-hospital",
            searchTerms: [ "building", "emergency room", "medical center" ]
        }, {
            title: "fas fa-hospital-alt",
            searchTerms: [ "building", "emergency room", "medical center" ]
        }, {
            title: "fas fa-hospital-symbol",
            searchTerms: []
        }, {
            title: "fas fa-hot-tub",
            searchTerms: []
        }, {
            title: "fas fa-hotel",
            searchTerms: [ "building", "lodging" ]
        }, {
            title: "fab fa-hotjar",
            searchTerms: []
        }, {
            title: "fas fa-hourglass",
            searchTerms: []
        }, {
            title: "far fa-hourglass",
            searchTerms: []
        }, {
            title: "fas fa-hourglass-end",
            searchTerms: []
        }, {
            title: "fas fa-hourglass-half",
            searchTerms: []
        }, {
            title: "fas fa-hourglass-start",
            searchTerms: []
        }, {
            title: "fas fa-house-damage",
            searchTerms: [ "devastation", "home" ]
        }, {
            title: "fab fa-houzz",
            searchTerms: []
        }, {
            title: "fas fa-hryvnia",
            searchTerms: [ "money" ]
        }, {
            title: "fab fa-html5",
            searchTerms: []
        }, {
            title: "fab fa-hubspot",
            searchTerms: []
        }, {
            title: "fas fa-i-cursor",
            searchTerms: []
        }, {
            title: "fas fa-id-badge",
            searchTerms: []
        }, {
            title: "far fa-id-badge",
            searchTerms: []
        }, {
            title: "fas fa-id-card",
            searchTerms: [ "document", "identification", "issued" ]
        }, {
            title: "far fa-id-card",
            searchTerms: [ "document", "identification", "issued" ]
        }, {
            title: "fas fa-id-card-alt",
            searchTerms: [ "demographics" ]
        }, {
            title: "fas fa-image",
            searchTerms: [ "album", "photo", "picture" ]
        }, {
            title: "far fa-image",
            searchTerms: [ "album", "photo", "picture" ]
        }, {
            title: "fas fa-images",
            searchTerms: [ "album", "photo", "picture" ]
        }, {
            title: "far fa-images",
            searchTerms: [ "album", "photo", "picture" ]
        }, {
            title: "fab fa-imdb",
            searchTerms: []
        }, {
            title: "fas fa-inbox",
            searchTerms: []
        }, {
            title: "fas fa-indent",
            searchTerms: []
        }, {
            title: "fas fa-industry",
            searchTerms: [ "factory", "manufacturing" ]
        }, {
            title: "fas fa-infinity",
            searchTerms: []
        }, {
            title: "fas fa-info",
            searchTerms: [ "details", "help", "information", "more" ]
        }, {
            title: "fas fa-info-circle",
            searchTerms: [ "details", "help", "information", "more" ]
        }, {
            title: "fab fa-instagram",
            searchTerms: []
        }, {
            title: "fab fa-internet-explorer",
            searchTerms: [ "browser", "ie" ]
        }, {
            title: "fab fa-ioxhost",
            searchTerms: []
        }, {
            title: "fas fa-italic",
            searchTerms: [ "italics" ]
        }, {
            title: "fab fa-itunes",
            searchTerms: []
        }, {
            title: "fab fa-itunes-note",
            searchTerms: []
        }, {
            title: "fab fa-java",
            searchTerms: []
        }, {
            title: "fas fa-jedi",
            searchTerms: [ "star wars" ]
        }, {
            title: "fab fa-jedi-order",
            searchTerms: [ "star wars" ]
        }, {
            title: "fab fa-jenkins",
            searchTerms: []
        }, {
            title: "fab fa-joget",
            searchTerms: []
        }, {
            title: "fas fa-joint",
            searchTerms: [ "blunt", "cannabis", "doobie", "drugs", "marijuana", "roach", "smoke", "smoking", "spliff" ]
        }, {
            title: "fab fa-joomla",
            searchTerms: []
        }, {
            title: "fas fa-journal-whills",
            searchTerms: [ "book", "jedi", "star wars", "the force" ]
        }, {
            title: "fab fa-js",
            searchTerms: []
        }, {
            title: "fab fa-js-square",
            searchTerms: []
        }, {
            title: "fab fa-jsfiddle",
            searchTerms: []
        }, {
            title: "fas fa-kaaba",
            searchTerms: [ "building", "cube", "islam", "muslim" ]
        }, {
            title: "fab fa-kaggle",
            searchTerms: []
        }, {
            title: "fas fa-key",
            searchTerms: [ "password", "unlock" ]
        }, {
            title: "fab fa-keybase",
            searchTerms: []
        }, {
            title: "fas fa-keyboard",
            searchTerms: [ "input", "type" ]
        }, {
            title: "far fa-keyboard",
            searchTerms: [ "input", "type" ]
        }, {
            title: "fab fa-keycdn",
            searchTerms: []
        }, {
            title: "fas fa-khanda",
            searchTerms: [ "chakkar", "sikh", "sikhism", "sword" ]
        }, {
            title: "fab fa-kickstarter",
            searchTerms: []
        }, {
            title: "fab fa-kickstarter-k",
            searchTerms: []
        }, {
            title: "fas fa-kiss",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "far fa-kiss",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "fas fa-kiss-beam",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "far fa-kiss-beam",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "fas fa-kiss-wink-heart",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "far fa-kiss-wink-heart",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "fas fa-kiwi-bird",
            searchTerms: [ "bird", "fauna" ]
        }, {
            title: "fab fa-korvue",
            searchTerms: []
        }, {
            title: "fas fa-landmark",
            searchTerms: [ "building", "historic", "memoroable", "politics" ]
        }, {
            title: "fas fa-language",
            searchTerms: [ "dialect", "idiom", "localize", "speech", "translate", "vernacular" ]
        }, {
            title: "fas fa-laptop",
            searchTerms: [ "computer", "cpu", "dell", "demo", "device", "dude you're getting", "mac", "macbook", "machine", "pc" ]
        }, {
            title: "fas fa-laptop-code",
            searchTerms: []
        }, {
            title: "fab fa-laravel",
            searchTerms: []
        }, {
            title: "fab fa-lastfm",
            searchTerms: []
        }, {
            title: "fab fa-lastfm-square",
            searchTerms: []
        }, {
            title: "fas fa-laugh",
            searchTerms: [ "LOL", "emoticon", "face", "laugh" ]
        }, {
            title: "far fa-laugh",
            searchTerms: [ "LOL", "emoticon", "face", "laugh" ]
        }, {
            title: "fas fa-laugh-beam",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-laugh-beam",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-laugh-squint",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-laugh-squint",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-laugh-wink",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "far fa-laugh-wink",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "fas fa-layer-group",
            searchTerms: [ "layers" ]
        }, {
            title: "fas fa-leaf",
            searchTerms: [ "eco", "flora", "nature", "plant" ]
        }, {
            title: "fab fa-leanpub",
            searchTerms: []
        }, {
            title: "fas fa-lemon",
            searchTerms: [ "food" ]
        }, {
            title: "far fa-lemon",
            searchTerms: [ "food" ]
        }, {
            title: "fab fa-less",
            searchTerms: []
        }, {
            title: "fas fa-less-than",
            searchTerms: []
        }, {
            title: "fas fa-less-than-equal",
            searchTerms: []
        }, {
            title: "fas fa-level-down-alt",
            searchTerms: [ "level-down" ]
        }, {
            title: "fas fa-level-up-alt",
            searchTerms: [ "level-up" ]
        }, {
            title: "fas fa-life-ring",
            searchTerms: [ "support" ]
        }, {
            title: "far fa-life-ring",
            searchTerms: [ "support" ]
        }, {
            title: "fas fa-lightbulb",
            searchTerms: [ "idea", "inspiration" ]
        }, {
            title: "far fa-lightbulb",
            searchTerms: [ "idea", "inspiration" ]
        }, {
            title: "fab fa-line",
            searchTerms: []
        }, {
            title: "fas fa-link",
            searchTerms: [ "chain" ]
        }, {
            title: "fab fa-linkedin",
            searchTerms: [ "linkedin-square" ]
        }, {
            title: "fab fa-linkedin-in",
            searchTerms: [ "linkedin" ]
        }, {
            title: "fab fa-linode",
            searchTerms: []
        }, {
            title: "fab fa-linux",
            searchTerms: [ "tux" ]
        }, {
            title: "fas fa-lira-sign",
            searchTerms: [ "try", "turkish" ]
        }, {
            title: "fas fa-list",
            searchTerms: [ "checklist", "completed", "done", "finished", "ol", "todo", "ul" ]
        }, {
            title: "fas fa-list-alt",
            searchTerms: [ "checklist", "completed", "done", "finished", "ol", "todo", "ul" ]
        }, {
            title: "far fa-list-alt",
            searchTerms: [ "checklist", "completed", "done", "finished", "ol", "todo", "ul" ]
        }, {
            title: "fas fa-list-ol",
            searchTerms: [ "checklist", "list", "numbers", "ol", "todo", "ul" ]
        }, {
            title: "fas fa-list-ul",
            searchTerms: [ "checklist", "list", "ol", "todo", "ul" ]
        }, {
            title: "fas fa-location-arrow",
            searchTerms: [ "address", "coordinates", "gps", "location", "map", "place", "where" ]
        }, {
            title: "fas fa-lock",
            searchTerms: [ "admin", "protect", "security" ]
        }, {
            title: "fas fa-lock-open",
            searchTerms: [ "admin", "lock", "open", "password", "protect" ]
        }, {
            title: "fas fa-long-arrow-alt-down",
            searchTerms: [ "long-arrow-down" ]
        }, {
            title: "fas fa-long-arrow-alt-left",
            searchTerms: [ "back", "long-arrow-left", "previous" ]
        }, {
            title: "fas fa-long-arrow-alt-right",
            searchTerms: [ "long-arrow-right" ]
        }, {
            title: "fas fa-long-arrow-alt-up",
            searchTerms: [ "long-arrow-up" ]
        }, {
            title: "fas fa-low-vision",
            searchTerms: []
        }, {
            title: "fas fa-luggage-cart",
            searchTerms: []
        }, {
            title: "fab fa-lyft",
            searchTerms: []
        }, {
            title: "fab fa-magento",
            searchTerms: []
        }, {
            title: "fas fa-magic",
            searchTerms: [ "autocomplete", "automatic", "mage", "magic", "spell", "witch", "wizard" ]
        }, {
            title: "fas fa-magnet",
            searchTerms: []
        }, {
            title: "fas fa-mail-bulk",
            searchTerms: []
        }, {
            title: "fab fa-mailchimp",
            searchTerms: []
        }, {
            title: "fas fa-male",
            searchTerms: [ "human", "man", "person", "profile", "user" ]
        }, {
            title: "fab fa-mandalorian",
            searchTerms: []
        }, {
            title: "fas fa-map",
            searchTerms: [ "coordinates", "location", "paper", "place", "travel" ]
        }, {
            title: "far fa-map",
            searchTerms: [ "coordinates", "location", "paper", "place", "travel" ]
        }, {
            title: "fas fa-map-marked",
            searchTerms: [ "address", "coordinates", "destination", "gps", "localize", "location", "map", "paper", "pin", "place", "point of interest", "position", "route", "travel", "where" ]
        }, {
            title: "fas fa-map-marked-alt",
            searchTerms: [ "address", "coordinates", "destination", "gps", "localize", "location", "map", "paper", "pin", "place", "point of interest", "position", "route", "travel", "where" ]
        }, {
            title: "fas fa-map-marker",
            searchTerms: [ "address", "coordinates", "gps", "localize", "location", "map", "pin", "place", "position", "travel", "where" ]
        }, {
            title: "fas fa-map-marker-alt",
            searchTerms: [ "address", "coordinates", "gps", "localize", "location", "map", "pin", "place", "position", "travel", "where" ]
        }, {
            title: "fas fa-map-pin",
            searchTerms: [ "address", "coordinates", "gps", "localize", "location", "map", "marker", "place", "position", "travel", "where" ]
        }, {
            title: "fas fa-map-signs",
            searchTerms: []
        }, {
            title: "fab fa-markdown",
            searchTerms: []
        }, {
            title: "fas fa-marker",
            searchTerms: [ "edit", "sharpie", "update", "write" ]
        }, {
            title: "fas fa-mars",
            searchTerms: [ "male" ]
        }, {
            title: "fas fa-mars-double",
            searchTerms: []
        }, {
            title: "fas fa-mars-stroke",
            searchTerms: []
        }, {
            title: "fas fa-mars-stroke-h",
            searchTerms: []
        }, {
            title: "fas fa-mars-stroke-v",
            searchTerms: []
        }, {
            title: "fas fa-mask",
            searchTerms: [ "costume", "disguise", "halloween", "holiday", "secret", "super hero" ]
        }, {
            title: "fab fa-mastodon",
            searchTerms: []
        }, {
            title: "fab fa-maxcdn",
            searchTerms: []
        }, {
            title: "fas fa-medal",
            searchTerms: []
        }, {
            title: "fab fa-medapps",
            searchTerms: []
        }, {
            title: "fab fa-medium",
            searchTerms: []
        }, {
            title: "fab fa-medium-m",
            searchTerms: []
        }, {
            title: "fas fa-medkit",
            searchTerms: [ "first aid", "firstaid", "health", "help", "support" ]
        }, {
            title: "fab fa-medrt",
            searchTerms: []
        }, {
            title: "fab fa-meetup",
            searchTerms: []
        }, {
            title: "fab fa-megaport",
            searchTerms: []
        }, {
            title: "fas fa-meh",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "far fa-meh",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "fas fa-meh-blank",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "far fa-meh-blank",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "fas fa-meh-rolling-eyes",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "far fa-meh-rolling-eyes",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "fas fa-memory",
            searchTerms: [ "DIMM", "RAM" ]
        }, {
            title: "fas fa-menorah",
            searchTerms: [ "candle", "hanukkah", "jewish", "judaism", "light" ]
        }, {
            title: "fas fa-mercury",
            searchTerms: [ "transgender" ]
        }, {
            title: "fas fa-meteor",
            searchTerms: []
        }, {
            title: "fas fa-microchip",
            searchTerms: [ "cpu", "processor" ]
        }, {
            title: "fas fa-microphone",
            searchTerms: [ "record", "sound", "voice" ]
        }, {
            title: "fas fa-microphone-alt",
            searchTerms: [ "record", "sound", "voice" ]
        }, {
            title: "fas fa-microphone-alt-slash",
            searchTerms: [ "disable", "mute", "record", "sound", "voice" ]
        }, {
            title: "fas fa-microphone-slash",
            searchTerms: [ "disable", "mute", "record", "sound", "voice" ]
        }, {
            title: "fas fa-microscope",
            searchTerms: []
        }, {
            title: "fab fa-microsoft",
            searchTerms: []
        }, {
            title: "fas fa-minus",
            searchTerms: [ "collapse", "delete", "hide", "minify", "negative", "remove", "trash" ]
        }, {
            title: "fas fa-minus-circle",
            searchTerms: [ "delete", "hide", "negative", "remove", "trash" ]
        }, {
            title: "fas fa-minus-square",
            searchTerms: [ "collapse", "delete", "hide", "minify", "negative", "remove", "trash" ]
        }, {
            title: "far fa-minus-square",
            searchTerms: [ "collapse", "delete", "hide", "minify", "negative", "remove", "trash" ]
        }, {
            title: "fab fa-mix",
            searchTerms: []
        }, {
            title: "fab fa-mixcloud",
            searchTerms: []
        }, {
            title: "fab fa-mizuni",
            searchTerms: []
        }, {
            title: "fas fa-mobile",
            searchTerms: [ "apple", "call", "cell phone", "cellphone", "device", "iphone", "number", "screen", "telephone", "text" ]
        }, {
            title: "fas fa-mobile-alt",
            searchTerms: [ "apple", "call", "cell phone", "cellphone", "device", "iphone", "number", "screen", "telephone", "text" ]
        }, {
            title: "fab fa-modx",
            searchTerms: []
        }, {
            title: "fab fa-monero",
            searchTerms: []
        }, {
            title: "fas fa-money-bill",
            searchTerms: [ "buy", "cash", "checkout", "money", "payment", "price", "purchase" ]
        }, {
            title: "fas fa-money-bill-alt",
            searchTerms: [ "buy", "cash", "checkout", "money", "payment", "price", "purchase" ]
        }, {
            title: "far fa-money-bill-alt",
            searchTerms: [ "buy", "cash", "checkout", "money", "payment", "price", "purchase" ]
        }, {
            title: "fas fa-money-bill-wave",
            searchTerms: []
        }, {
            title: "fas fa-money-bill-wave-alt",
            searchTerms: []
        }, {
            title: "fas fa-money-check",
            searchTerms: [ "bank check", "cheque" ]
        }, {
            title: "fas fa-money-check-alt",
            searchTerms: [ "bank check", "cheque" ]
        }, {
            title: "fas fa-monument",
            searchTerms: [ "building", "historic", "memoroable" ]
        }, {
            title: "fas fa-moon",
            searchTerms: [ "contrast", "crescent", "darker", "lunar", "night" ]
        }, {
            title: "far fa-moon",
            searchTerms: [ "contrast", "crescent", "darker", "lunar", "night" ]
        }, {
            title: "fas fa-mortar-pestle",
            searchTerms: [ "crush", "culinary", "grind", "medical", "mix", "spices" ]
        }, {
            title: "fas fa-mosque",
            searchTerms: [ "building", "islam", "muslim" ]
        }, {
            title: "fas fa-motorcycle",
            searchTerms: [ "bike", "machine", "transportation", "vehicle" ]
        }, {
            title: "fas fa-mountain",
            searchTerms: []
        }, {
            title: "fas fa-mouse-pointer",
            searchTerms: [ "select" ]
        }, {
            title: "fas fa-music",
            searchTerms: [ "note", "sound" ]
        }, {
            title: "fab fa-napster",
            searchTerms: []
        }, {
            title: "fab fa-neos",
            searchTerms: []
        }, {
            title: "fas fa-network-wired",
            searchTerms: []
        }, {
            title: "fas fa-neuter",
            searchTerms: []
        }, {
            title: "fas fa-newspaper",
            searchTerms: [ "article", "press" ]
        }, {
            title: "far fa-newspaper",
            searchTerms: [ "article", "press" ]
        }, {
            title: "fab fa-nimblr",
            searchTerms: []
        }, {
            title: "fab fa-nintendo-switch",
            searchTerms: []
        }, {
            title: "fab fa-node",
            searchTerms: []
        }, {
            title: "fab fa-node-js",
            searchTerms: []
        }, {
            title: "fas fa-not-equal",
            searchTerms: []
        }, {
            title: "fas fa-notes-medical",
            searchTerms: []
        }, {
            title: "fab fa-npm",
            searchTerms: []
        }, {
            title: "fab fa-ns8",
            searchTerms: []
        }, {
            title: "fab fa-nutritionix",
            searchTerms: []
        }, {
            title: "fas fa-object-group",
            searchTerms: [ "design" ]
        }, {
            title: "far fa-object-group",
            searchTerms: [ "design" ]
        }, {
            title: "fas fa-object-ungroup",
            searchTerms: [ "design" ]
        }, {
            title: "far fa-object-ungroup",
            searchTerms: [ "design" ]
        }, {
            title: "fab fa-odnoklassniki",
            searchTerms: []
        }, {
            title: "fab fa-odnoklassniki-square",
            searchTerms: []
        }, {
            title: "fas fa-oil-can",
            searchTerms: []
        }, {
            title: "fab fa-old-republic",
            searchTerms: [ "politics", "star wars" ]
        }, {
            title: "fas fa-om",
            searchTerms: [ "buddhism", "hinduism", "jainism", "mantra" ]
        }, {
            title: "fab fa-opencart",
            searchTerms: []
        }, {
            title: "fab fa-openid",
            searchTerms: []
        }, {
            title: "fab fa-opera",
            searchTerms: []
        }, {
            title: "fab fa-optin-monster",
            searchTerms: []
        }, {
            title: "fab fa-osi",
            searchTerms: []
        }, {
            title: "fas fa-otter",
            searchTerms: [ "fauna", "mammmal" ]
        }, {
            title: "fas fa-outdent",
            searchTerms: []
        }, {
            title: "fab fa-page4",
            searchTerms: []
        }, {
            title: "fab fa-pagelines",
            searchTerms: [ "eco", "flora", "leaf", "leaves", "nature", "plant", "tree" ]
        }, {
            title: "fas fa-paint-brush",
            searchTerms: []
        }, {
            title: "fas fa-paint-roller",
            searchTerms: [ "brush", "painting", "tool" ]
        }, {
            title: "fas fa-palette",
            searchTerms: [ "colors", "painting" ]
        }, {
            title: "fab fa-palfed",
            searchTerms: []
        }, {
            title: "fas fa-pallet",
            searchTerms: []
        }, {
            title: "fas fa-paper-plane",
            searchTerms: []
        }, {
            title: "far fa-paper-plane",
            searchTerms: []
        }, {
            title: "fas fa-paperclip",
            searchTerms: [ "attachment" ]
        }, {
            title: "fas fa-parachute-box",
            searchTerms: [ "aid", "assistance", "rescue", "supplies" ]
        }, {
            title: "fas fa-paragraph",
            searchTerms: []
        }, {
            title: "fas fa-parking",
            searchTerms: []
        }, {
            title: "fas fa-passport",
            searchTerms: [ "document", "identification", "issued" ]
        }, {
            title: "fas fa-pastafarianism",
            searchTerms: [ "agnosticism", "atheism", "flying spaghetti monster", "fsm" ]
        }, {
            title: "fas fa-paste",
            searchTerms: [ "clipboard", "copy" ]
        }, {
            title: "fab fa-patreon",
            searchTerms: []
        }, {
            title: "fas fa-pause",
            searchTerms: [ "wait" ]
        }, {
            title: "fas fa-pause-circle",
            searchTerms: []
        }, {
            title: "far fa-pause-circle",
            searchTerms: []
        }, {
            title: "fas fa-paw",
            searchTerms: [ "animal", "pet" ]
        }, {
            title: "fab fa-paypal",
            searchTerms: []
        }, {
            title: "fas fa-peace",
            searchTerms: []
        }, {
            title: "fas fa-pen",
            searchTerms: [ "design", "edit", "update", "write" ]
        }, {
            title: "fas fa-pen-alt",
            searchTerms: [ "design", "edit", "update", "write" ]
        }, {
            title: "fas fa-pen-fancy",
            searchTerms: [ "design", "edit", "fountain pen", "update", "write" ]
        }, {
            title: "fas fa-pen-nib",
            searchTerms: [ "design", "edit", "fountain pen", "update", "write" ]
        }, {
            title: "fas fa-pen-square",
            searchTerms: [ "edit", "pencil-square", "update", "write" ]
        }, {
            title: "fas fa-pencil-alt",
            searchTerms: [ "design", "edit", "pencil", "update", "write" ]
        }, {
            title: "fas fa-pencil-ruler",
            searchTerms: []
        }, {
            title: "fab fa-penny-arcade",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "game", "gaming", "pax", "tabletop" ]
        }, {
            title: "fas fa-people-carry",
            searchTerms: [ "movers" ]
        }, {
            title: "fas fa-percent",
            searchTerms: []
        }, {
            title: "fas fa-percentage",
            searchTerms: []
        }, {
            title: "fab fa-periscope",
            searchTerms: []
        }, {
            title: "fas fa-person-booth",
            searchTerms: [ "changing", "changing room", "election", "human", "person", "vote", "voting" ]
        }, {
            title: "fab fa-phabricator",
            searchTerms: []
        }, {
            title: "fab fa-phoenix-framework",
            searchTerms: []
        }, {
            title: "fab fa-phoenix-squadron",
            searchTerms: []
        }, {
            title: "fas fa-phone",
            searchTerms: [ "call", "earphone", "number", "support", "telephone", "voice" ]
        }, {
            title: "fas fa-phone-slash",
            searchTerms: []
        }, {
            title: "fas fa-phone-square",
            searchTerms: [ "call", "number", "support", "telephone", "voice" ]
        }, {
            title: "fas fa-phone-volume",
            searchTerms: [ "telephone", "volume-control-phone" ]
        }, {
            title: "fab fa-php",
            searchTerms: []
        }, {
            title: "fab fa-pied-piper",
            searchTerms: []
        }, {
            title: "fab fa-pied-piper-alt",
            searchTerms: []
        }, {
            title: "fab fa-pied-piper-hat",
            searchTerms: [ "clothing" ]
        }, {
            title: "fab fa-pied-piper-pp",
            searchTerms: []
        }, {
            title: "fas fa-piggy-bank",
            searchTerms: [ "save", "savings" ]
        }, {
            title: "fas fa-pills",
            searchTerms: [ "drugs", "medicine" ]
        }, {
            title: "fab fa-pinterest",
            searchTerms: []
        }, {
            title: "fab fa-pinterest-p",
            searchTerms: []
        }, {
            title: "fab fa-pinterest-square",
            searchTerms: []
        }, {
            title: "fas fa-place-of-worship",
            searchTerms: []
        }, {
            title: "fas fa-plane",
            searchTerms: [ "airplane", "destination", "fly", "location", "mode", "travel", "trip" ]
        }, {
            title: "fas fa-plane-arrival",
            searchTerms: [ "airplane", "arriving", "destination", "fly", "land", "landing", "location", "mode", "travel", "trip" ]
        }, {
            title: "fas fa-plane-departure",
            searchTerms: [ "airplane", "departing", "destination", "fly", "location", "mode", "take off", "taking off", "travel", "trip" ]
        }, {
            title: "fas fa-play",
            searchTerms: [ "music", "playing", "sound", "start" ]
        }, {
            title: "fas fa-play-circle",
            searchTerms: [ "playing", "start" ]
        }, {
            title: "far fa-play-circle",
            searchTerms: [ "playing", "start" ]
        }, {
            title: "fab fa-playstation",
            searchTerms: []
        }, {
            title: "fas fa-plug",
            searchTerms: [ "connect", "online", "power" ]
        }, {
            title: "fas fa-plus",
            searchTerms: [ "add", "create", "expand", "new", "positive" ]
        }, {
            title: "fas fa-plus-circle",
            searchTerms: [ "add", "create", "expand", "new", "positive" ]
        }, {
            title: "fas fa-plus-square",
            searchTerms: [ "add", "create", "expand", "new", "positive" ]
        }, {
            title: "far fa-plus-square",
            searchTerms: [ "add", "create", "expand", "new", "positive" ]
        }, {
            title: "fas fa-podcast",
            searchTerms: []
        }, {
            title: "fas fa-poll",
            searchTerms: [ "results", "survey", "vote", "voting" ]
        }, {
            title: "fas fa-poll-h",
            searchTerms: [ "results", "survey", "vote", "voting" ]
        }, {
            title: "fas fa-poo",
            searchTerms: []
        }, {
            title: "fas fa-poo-storm",
            searchTerms: [ "mess", "poop", "shit" ]
        }, {
            title: "fas fa-poop",
            searchTerms: []
        }, {
            title: "fas fa-portrait",
            searchTerms: []
        }, {
            title: "fas fa-pound-sign",
            searchTerms: [ "gbp" ]
        }, {
            title: "fas fa-power-off",
            searchTerms: [ "on", "reboot", "restart" ]
        }, {
            title: "fas fa-pray",
            searchTerms: []
        }, {
            title: "fas fa-praying-hands",
            searchTerms: []
        }, {
            title: "fas fa-prescription",
            searchTerms: [ "drugs", "medical", "medicine", "rx" ]
        }, {
            title: "fas fa-prescription-bottle",
            searchTerms: [ "drugs", "medical", "medicine", "rx" ]
        }, {
            title: "fas fa-prescription-bottle-alt",
            searchTerms: [ "drugs", "medical", "medicine", "rx" ]
        }, {
            title: "fas fa-print",
            searchTerms: []
        }, {
            title: "fas fa-procedures",
            searchTerms: []
        }, {
            title: "fab fa-product-hunt",
            searchTerms: []
        }, {
            title: "fas fa-project-diagram",
            searchTerms: []
        }, {
            title: "fab fa-pushed",
            searchTerms: []
        }, {
            title: "fas fa-puzzle-piece",
            searchTerms: [ "add-on", "addon", "section" ]
        }, {
            title: "fab fa-python",
            searchTerms: []
        }, {
            title: "fab fa-qq",
            searchTerms: []
        }, {
            title: "fas fa-qrcode",
            searchTerms: [ "scan" ]
        }, {
            title: "fas fa-question",
            searchTerms: [ "help", "information", "support", "unknown" ]
        }, {
            title: "fas fa-question-circle",
            searchTerms: [ "help", "information", "support", "unknown" ]
        }, {
            title: "far fa-question-circle",
            searchTerms: [ "help", "information", "support", "unknown" ]
        }, {
            title: "fas fa-quidditch",
            searchTerms: []
        }, {
            title: "fab fa-quinscape",
            searchTerms: []
        }, {
            title: "fab fa-quora",
            searchTerms: []
        }, {
            title: "fas fa-quote-left",
            searchTerms: []
        }, {
            title: "fas fa-quote-right",
            searchTerms: []
        }, {
            title: "fas fa-quran",
            searchTerms: [ "book", "islam", "muslim" ]
        }, {
            title: "fab fa-r-project",
            searchTerms: []
        }, {
            title: "fas fa-rainbow",
            searchTerms: []
        }, {
            title: "fas fa-random",
            searchTerms: [ "shuffle", "sort" ]
        }, {
            title: "fab fa-ravelry",
            searchTerms: []
        }, {
            title: "fab fa-react",
            searchTerms: []
        }, {
            title: "fab fa-reacteurope",
            searchTerms: []
        }, {
            title: "fab fa-readme",
            searchTerms: []
        }, {
            title: "fab fa-rebel",
            searchTerms: []
        }, {
            title: "fas fa-receipt",
            searchTerms: [ "check", "invoice", "table" ]
        }, {
            title: "fas fa-recycle",
            searchTerms: []
        }, {
            title: "fab fa-red-river",
            searchTerms: []
        }, {
            title: "fab fa-reddit",
            searchTerms: []
        }, {
            title: "fab fa-reddit-alien",
            searchTerms: []
        }, {
            title: "fab fa-reddit-square",
            searchTerms: []
        }, {
            title: "fas fa-redo",
            searchTerms: [ "forward", "refresh", "reload", "repeat" ]
        }, {
            title: "fas fa-redo-alt",
            searchTerms: [ "forward", "refresh", "reload", "repeat" ]
        }, {
            title: "fas fa-registered",
            searchTerms: []
        }, {
            title: "far fa-registered",
            searchTerms: []
        }, {
            title: "fab fa-renren",
            searchTerms: []
        }, {
            title: "fas fa-reply",
            searchTerms: []
        }, {
            title: "fas fa-reply-all",
            searchTerms: []
        }, {
            title: "fab fa-replyd",
            searchTerms: []
        }, {
            title: "fas fa-republican",
            searchTerms: [ "american", "conservative", "election", "elephant", "politics", "republican party", "right", "right-wing", "usa" ]
        }, {
            title: "fab fa-researchgate",
            searchTerms: []
        }, {
            title: "fab fa-resolving",
            searchTerms: []
        }, {
            title: "fas fa-retweet",
            searchTerms: [ "refresh", "reload", "share", "swap" ]
        }, {
            title: "fab fa-rev",
            searchTerms: []
        }, {
            title: "fas fa-ribbon",
            searchTerms: [ "badge", "cause", "lapel", "pin" ]
        }, {
            title: "fas fa-ring",
            searchTerms: [ "Dungeons & Dragons", "Gollum", "band", "binding", "d&d", "dnd", "fantasy", "jewelry", "precious" ]
        }, {
            title: "fas fa-road",
            searchTerms: [ "street" ]
        }, {
            title: "fas fa-robot",
            searchTerms: []
        }, {
            title: "fas fa-rocket",
            searchTerms: [ "app" ]
        }, {
            title: "fab fa-rocketchat",
            searchTerms: []
        }, {
            title: "fab fa-rockrms",
            searchTerms: []
        }, {
            title: "fas fa-route",
            searchTerms: []
        }, {
            title: "fas fa-rss",
            searchTerms: [ "blog" ]
        }, {
            title: "fas fa-rss-square",
            searchTerms: [ "blog", "feed" ]
        }, {
            title: "fas fa-ruble-sign",
            searchTerms: [ "rub" ]
        }, {
            title: "fas fa-ruler",
            searchTerms: []
        }, {
            title: "fas fa-ruler-combined",
            searchTerms: []
        }, {
            title: "fas fa-ruler-horizontal",
            searchTerms: []
        }, {
            title: "fas fa-ruler-vertical",
            searchTerms: []
        }, {
            title: "fas fa-running",
            searchTerms: [ "jog", "sprint" ]
        }, {
            title: "fas fa-rupee-sign",
            searchTerms: [ "indian", "inr" ]
        }, {
            title: "fas fa-sad-cry",
            searchTerms: [ "emoticon", "face", "tear", "tears" ]
        }, {
            title: "far fa-sad-cry",
            searchTerms: [ "emoticon", "face", "tear", "tears" ]
        }, {
            title: "fas fa-sad-tear",
            searchTerms: [ "emoticon", "face", "tear", "tears" ]
        }, {
            title: "far fa-sad-tear",
            searchTerms: [ "emoticon", "face", "tear", "tears" ]
        }, {
            title: "fab fa-safari",
            searchTerms: [ "browser" ]
        }, {
            title: "fab fa-sass",
            searchTerms: []
        }, {
            title: "fas fa-save",
            searchTerms: [ "floppy", "floppy-o" ]
        }, {
            title: "far fa-save",
            searchTerms: [ "floppy", "floppy-o" ]
        }, {
            title: "fab fa-schlix",
            searchTerms: []
        }, {
            title: "fas fa-school",
            searchTerms: []
        }, {
            title: "fas fa-screwdriver",
            searchTerms: [ "admin", "fix", "repair", "settings", "tool" ]
        }, {
            title: "fab fa-scribd",
            searchTerms: []
        }, {
            title: "fas fa-scroll",
            searchTerms: [ "Dungeons & Dragons", "announcement", "d&d", "dnd", "fantasy", "paper" ]
        }, {
            title: "fas fa-search",
            searchTerms: [ "bigger", "enlarge", "magnify", "preview", "zoom" ]
        }, {
            title: "fas fa-search-dollar",
            searchTerms: []
        }, {
            title: "fas fa-search-location",
            searchTerms: []
        }, {
            title: "fas fa-search-minus",
            searchTerms: [ "minify", "negative", "smaller", "zoom", "zoom out" ]
        }, {
            title: "fas fa-search-plus",
            searchTerms: [ "bigger", "enlarge", "magnify", "positive", "zoom", "zoom in" ]
        }, {
            title: "fab fa-searchengin",
            searchTerms: []
        }, {
            title: "fas fa-seedling",
            searchTerms: []
        }, {
            title: "fab fa-sellcast",
            searchTerms: [ "eercast" ]
        }, {
            title: "fab fa-sellsy",
            searchTerms: []
        }, {
            title: "fas fa-server",
            searchTerms: [ "cpu" ]
        }, {
            title: "fab fa-servicestack",
            searchTerms: []
        }, {
            title: "fas fa-shapes",
            searchTerms: [ "circle", "square", "triangle" ]
        }, {
            title: "fas fa-share",
            searchTerms: []
        }, {
            title: "fas fa-share-alt",
            searchTerms: []
        }, {
            title: "fas fa-share-alt-square",
            searchTerms: []
        }, {
            title: "fas fa-share-square",
            searchTerms: [ "send", "social" ]
        }, {
            title: "far fa-share-square",
            searchTerms: [ "send", "social" ]
        }, {
            title: "fas fa-shekel-sign",
            searchTerms: [ "ils" ]
        }, {
            title: "fas fa-shield-alt",
            searchTerms: [ "achievement", "award", "block", "defend", "security", "winner" ]
        }, {
            title: "fas fa-ship",
            searchTerms: [ "boat", "sea" ]
        }, {
            title: "fas fa-shipping-fast",
            searchTerms: []
        }, {
            title: "fab fa-shirtsinbulk",
            searchTerms: []
        }, {
            title: "fas fa-shoe-prints",
            searchTerms: [ "feet", "footprints", "steps" ]
        }, {
            title: "fas fa-shopping-bag",
            searchTerms: []
        }, {
            title: "fas fa-shopping-basket",
            searchTerms: []
        }, {
            title: "fas fa-shopping-cart",
            searchTerms: [ "buy", "checkout", "payment", "purchase" ]
        }, {
            title: "fab fa-shopware",
            searchTerms: []
        }, {
            title: "fas fa-shower",
            searchTerms: []
        }, {
            title: "fas fa-shuttle-van",
            searchTerms: [ "machine", "public-transportation", "transportation", "vehicle" ]
        }, {
            title: "fas fa-sign",
            searchTerms: []
        }, {
            title: "fas fa-sign-in-alt",
            searchTerms: [ "arrow", "enter", "join", "log in", "login", "sign in", "sign up", "sign-in", "signin", "signup" ]
        }, {
            title: "fas fa-sign-language",
            searchTerms: []
        }, {
            title: "fas fa-sign-out-alt",
            searchTerms: [ "arrow", "exit", "leave", "log out", "logout", "sign-out" ]
        }, {
            title: "fas fa-signal",
            searchTerms: [ "bars", "graph", "online", "status" ]
        }, {
            title: "fas fa-signature",
            searchTerms: [ "John Hancock", "cursive", "name", "writing" ]
        }, {
            title: "fab fa-simplybuilt",
            searchTerms: []
        }, {
            title: "fab fa-sistrix",
            searchTerms: []
        }, {
            title: "fas fa-sitemap",
            searchTerms: [ "directory", "hierarchy", "ia", "information architecture", "organization" ]
        }, {
            title: "fab fa-sith",
            searchTerms: []
        }, {
            title: "fas fa-skull",
            searchTerms: [ "bones", "skeleton", "yorick" ]
        }, {
            title: "fas fa-skull-crossbones",
            searchTerms: [ "Dungeons & Dragons", "alert", "bones", "d&d", "danger", "dead", "deadly", "death", "dnd", "fantasy", "halloween", "holiday", "jolly-roger", "pirate", "poison", "skeleton", "warning" ]
        }, {
            title: "fab fa-skyatlas",
            searchTerms: []
        }, {
            title: "fab fa-skype",
            searchTerms: []
        }, {
            title: "fab fa-slack",
            searchTerms: [ "anchor", "hash", "hashtag" ]
        }, {
            title: "fab fa-slack-hash",
            searchTerms: [ "anchor", "hash", "hashtag" ]
        }, {
            title: "fas fa-slash",
            searchTerms: []
        }, {
            title: "fas fa-sliders-h",
            searchTerms: [ "settings", "sliders" ]
        }, {
            title: "fab fa-slideshare",
            searchTerms: []
        }, {
            title: "fas fa-smile",
            searchTerms: [ "approve", "emoticon", "face", "happy", "rating", "satisfied" ]
        }, {
            title: "far fa-smile",
            searchTerms: [ "approve", "emoticon", "face", "happy", "rating", "satisfied" ]
        }, {
            title: "fas fa-smile-beam",
            searchTerms: [ "emoticon", "face", "happy", "positive" ]
        }, {
            title: "far fa-smile-beam",
            searchTerms: [ "emoticon", "face", "happy", "positive" ]
        }, {
            title: "fas fa-smile-wink",
            searchTerms: [ "emoticon", "face", "happy" ]
        }, {
            title: "far fa-smile-wink",
            searchTerms: [ "emoticon", "face", "happy" ]
        }, {
            title: "fas fa-smog",
            searchTerms: [ "dragon" ]
        }, {
            title: "fas fa-smoking",
            searchTerms: [ "cigarette", "nicotine", "smoking status" ]
        }, {
            title: "fas fa-smoking-ban",
            searchTerms: [ "no smoking", "non-smoking" ]
        }, {
            title: "fab fa-snapchat",
            searchTerms: []
        }, {
            title: "fab fa-snapchat-ghost",
            searchTerms: []
        }, {
            title: "fab fa-snapchat-square",
            searchTerms: []
        }, {
            title: "fas fa-snowflake",
            searchTerms: [ "precipitation", "seasonal", "winter" ]
        }, {
            title: "far fa-snowflake",
            searchTerms: [ "precipitation", "seasonal", "winter" ]
        }, {
            title: "fas fa-socks",
            searchTerms: [ "business socks", "business time", "flight of the conchords", "wednesday" ]
        }, {
            title: "fas fa-solar-panel",
            searchTerms: [ "clean", "eco-friendly", "energy", "green", "sun" ]
        }, {
            title: "fas fa-sort",
            searchTerms: [ "order" ]
        }, {
            title: "fas fa-sort-alpha-down",
            searchTerms: [ "sort-alpha-asc" ]
        }, {
            title: "fas fa-sort-alpha-up",
            searchTerms: [ "sort-alpha-desc" ]
        }, {
            title: "fas fa-sort-amount-down",
            searchTerms: [ "sort-amount-asc" ]
        }, {
            title: "fas fa-sort-amount-up",
            searchTerms: [ "sort-amount-desc" ]
        }, {
            title: "fas fa-sort-down",
            searchTerms: [ "arrow", "descending", "sort-desc" ]
        }, {
            title: "fas fa-sort-numeric-down",
            searchTerms: [ "numbers", "sort-numeric-asc" ]
        }, {
            title: "fas fa-sort-numeric-up",
            searchTerms: [ "numbers", "sort-numeric-desc" ]
        }, {
            title: "fas fa-sort-up",
            searchTerms: [ "arrow", "ascending", "sort-asc" ]
        }, {
            title: "fab fa-soundcloud",
            searchTerms: []
        }, {
            title: "fas fa-spa",
            searchTerms: [ "flora", "mindfullness", "plant", "wellness" ]
        }, {
            title: "fas fa-space-shuttle",
            searchTerms: [ "astronaut", "machine", "nasa", "rocket", "transportation" ]
        }, {
            title: "fab fa-speakap",
            searchTerms: []
        }, {
            title: "fas fa-spider",
            searchTerms: [ "arachnid", "bug", "charlotte", "crawl", "eight", "halloween", "holiday" ]
        }, {
            title: "fas fa-spinner",
            searchTerms: [ "loading", "progress" ]
        }, {
            title: "fas fa-splotch",
            searchTerms: []
        }, {
            title: "fab fa-spotify",
            searchTerms: []
        }, {
            title: "fas fa-spray-can",
            searchTerms: []
        }, {
            title: "fas fa-square",
            searchTerms: [ "block", "box" ]
        }, {
            title: "far fa-square",
            searchTerms: [ "block", "box" ]
        }, {
            title: "fas fa-square-full",
            searchTerms: []
        }, {
            title: "fas fa-square-root-alt",
            searchTerms: []
        }, {
            title: "fab fa-squarespace",
            searchTerms: []
        }, {
            title: "fab fa-stack-exchange",
            searchTerms: []
        }, {
            title: "fab fa-stack-overflow",
            searchTerms: []
        }, {
            title: "fas fa-stamp",
            searchTerms: []
        }, {
            title: "fas fa-star",
            searchTerms: [ "achievement", "award", "favorite", "important", "night", "rating", "score" ]
        }, {
            title: "far fa-star",
            searchTerms: [ "achievement", "award", "favorite", "important", "night", "rating", "score" ]
        }, {
            title: "fas fa-star-and-crescent",
            searchTerms: [ "islam", "muslim" ]
        }, {
            title: "fas fa-star-half",
            searchTerms: [ "achievement", "award", "rating", "score", "star-half-empty", "star-half-full" ]
        }, {
            title: "far fa-star-half",
            searchTerms: [ "achievement", "award", "rating", "score", "star-half-empty", "star-half-full" ]
        }, {
            title: "fas fa-star-half-alt",
            searchTerms: [ "achievement", "award", "rating", "score", "star-half-empty", "star-half-full" ]
        }, {
            title: "fas fa-star-of-david",
            searchTerms: [ "jewish", "judaism" ]
        }, {
            title: "fas fa-star-of-life",
            searchTerms: []
        }, {
            title: "fab fa-staylinked",
            searchTerms: []
        }, {
            title: "fab fa-steam",
            searchTerms: []
        }, {
            title: "fab fa-steam-square",
            searchTerms: []
        }, {
            title: "fab fa-steam-symbol",
            searchTerms: []
        }, {
            title: "fas fa-step-backward",
            searchTerms: [ "beginning", "first", "previous", "rewind", "start" ]
        }, {
            title: "fas fa-step-forward",
            searchTerms: [ "end", "last", "next" ]
        }, {
            title: "fas fa-stethoscope",
            searchTerms: []
        }, {
            title: "fab fa-sticker-mule",
            searchTerms: []
        }, {
            title: "fas fa-sticky-note",
            searchTerms: []
        }, {
            title: "far fa-sticky-note",
            searchTerms: []
        }, {
            title: "fas fa-stop",
            searchTerms: [ "block", "box", "square" ]
        }, {
            title: "fas fa-stop-circle",
            searchTerms: []
        }, {
            title: "far fa-stop-circle",
            searchTerms: []
        }, {
            title: "fas fa-stopwatch",
            searchTerms: [ "time" ]
        }, {
            title: "fas fa-store",
            searchTerms: []
        }, {
            title: "fas fa-store-alt",
            searchTerms: []
        }, {
            title: "fab fa-strava",
            searchTerms: []
        }, {
            title: "fas fa-stream",
            searchTerms: []
        }, {
            title: "fas fa-street-view",
            searchTerms: [ "map" ]
        }, {
            title: "fas fa-strikethrough",
            searchTerms: []
        }, {
            title: "fab fa-stripe",
            searchTerms: []
        }, {
            title: "fab fa-stripe-s",
            searchTerms: []
        }, {
            title: "fas fa-stroopwafel",
            searchTerms: [ "dessert", "food", "sweets", "waffle" ]
        }, {
            title: "fab fa-studiovinari",
            searchTerms: []
        }, {
            title: "fab fa-stumbleupon",
            searchTerms: []
        }, {
            title: "fab fa-stumbleupon-circle",
            searchTerms: []
        }, {
            title: "fas fa-subscript",
            searchTerms: []
        }, {
            title: "fas fa-subway",
            searchTerms: [ "machine", "railway", "train", "transportation", "vehicle" ]
        }, {
            title: "fas fa-suitcase",
            searchTerms: [ "baggage", "luggage", "move", "suitcase", "travel", "trip" ]
        }, {
            title: "fas fa-suitcase-rolling",
            searchTerms: []
        }, {
            title: "fas fa-sun",
            searchTerms: [ "brighten", "contrast", "day", "lighter", "sol", "solar", "star", "weather" ]
        }, {
            title: "far fa-sun",
            searchTerms: [ "brighten", "contrast", "day", "lighter", "sol", "solar", "star", "weather" ]
        }, {
            title: "fab fa-superpowers",
            searchTerms: []
        }, {
            title: "fas fa-superscript",
            searchTerms: [ "exponential" ]
        }, {
            title: "fab fa-supple",
            searchTerms: []
        }, {
            title: "fas fa-surprise",
            searchTerms: [ "emoticon", "face", "shocked" ]
        }, {
            title: "far fa-surprise",
            searchTerms: [ "emoticon", "face", "shocked" ]
        }, {
            title: "fas fa-swatchbook",
            searchTerms: []
        }, {
            title: "fas fa-swimmer",
            searchTerms: [ "athlete", "head", "man", "person", "water" ]
        }, {
            title: "fas fa-swimming-pool",
            searchTerms: [ "ladder", "recreation", "water" ]
        }, {
            title: "fas fa-synagogue",
            searchTerms: [ "building", "jewish", "judaism", "star of david", "temple" ]
        }, {
            title: "fas fa-sync",
            searchTerms: [ "exchange", "refresh", "reload", "rotate", "swap" ]
        }, {
            title: "fas fa-sync-alt",
            searchTerms: [ "refresh", "reload", "rotate" ]
        }, {
            title: "fas fa-syringe",
            searchTerms: [ "immunizations", "needle" ]
        }, {
            title: "fas fa-table",
            searchTerms: [ "data", "excel", "spreadsheet" ]
        }, {
            title: "fas fa-table-tennis",
            searchTerms: []
        }, {
            title: "fas fa-tablet",
            searchTerms: [ "apple", "device", "ipad", "kindle", "screen" ]
        }, {
            title: "fas fa-tablet-alt",
            searchTerms: [ "apple", "device", "ipad", "kindle", "screen" ]
        }, {
            title: "fas fa-tablets",
            searchTerms: [ "drugs", "medicine" ]
        }, {
            title: "fas fa-tachometer-alt",
            searchTerms: [ "dashboard", "tachometer" ]
        }, {
            title: "fas fa-tag",
            searchTerms: [ "label" ]
        }, {
            title: "fas fa-tags",
            searchTerms: [ "labels" ]
        }, {
            title: "fas fa-tape",
            searchTerms: []
        }, {
            title: "fas fa-tasks",
            searchTerms: [ "downloading", "downloads", "loading", "progress", "settings" ]
        }, {
            title: "fas fa-taxi",
            searchTerms: [ "cab", "cabbie", "car", "car service", "lyft", "machine", "transportation", "uber", "vehicle" ]
        }, {
            title: "fab fa-teamspeak",
            searchTerms: []
        }, {
            title: "fas fa-teeth",
            searchTerms: []
        }, {
            title: "fas fa-teeth-open",
            searchTerms: []
        }, {
            title: "fab fa-telegram",
            searchTerms: []
        }, {
            title: "fab fa-telegram-plane",
            searchTerms: []
        }, {
            title: "fas fa-temperature-high",
            searchTerms: [ "mercury", "thermometer", "warm" ]
        }, {
            title: "fas fa-temperature-low",
            searchTerms: [ "cool", "mercury", "thermometer" ]
        }, {
            title: "fab fa-tencent-weibo",
            searchTerms: []
        }, {
            title: "fas fa-terminal",
            searchTerms: [ "code", "command", "console", "prompt" ]
        }, {
            title: "fas fa-text-height",
            searchTerms: []
        }, {
            title: "fas fa-text-width",
            searchTerms: []
        }, {
            title: "fas fa-th",
            searchTerms: [ "blocks", "boxes", "grid", "squares" ]
        }, {
            title: "fas fa-th-large",
            searchTerms: [ "blocks", "boxes", "grid", "squares" ]
        }, {
            title: "fas fa-th-list",
            searchTerms: [ "checklist", "completed", "done", "finished", "ol", "todo", "ul" ]
        }, {
            title: "fab fa-the-red-yeti",
            searchTerms: []
        }, {
            title: "fas fa-theater-masks",
            searchTerms: []
        }, {
            title: "fab fa-themeco",
            searchTerms: []
        }, {
            title: "fab fa-themeisle",
            searchTerms: []
        }, {
            title: "fas fa-thermometer",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "fas fa-thermometer-empty",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "fas fa-thermometer-full",
            searchTerms: [ "fever", "mercury", "status", "temperature" ]
        }, {
            title: "fas fa-thermometer-half",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "fas fa-thermometer-quarter",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "fas fa-thermometer-three-quarters",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "fab fa-think-peaks",
            searchTerms: []
        }, {
            title: "fas fa-thumbs-down",
            searchTerms: [ "disagree", "disapprove", "dislike", "hand", "thumbs-o-down" ]
        }, {
            title: "far fa-thumbs-down",
            searchTerms: [ "disagree", "disapprove", "dislike", "hand", "thumbs-o-down" ]
        }, {
            title: "fas fa-thumbs-up",
            searchTerms: [ "agree", "approve", "favorite", "hand", "like", "ok", "okay", "success", "thumbs-o-up", "yes", "you got it dude" ]
        }, {
            title: "far fa-thumbs-up",
            searchTerms: [ "agree", "approve", "favorite", "hand", "like", "ok", "okay", "success", "thumbs-o-up", "yes", "you got it dude" ]
        }, {
            title: "fas fa-thumbtack",
            searchTerms: [ "coordinates", "location", "marker", "pin", "thumb-tack" ]
        }, {
            title: "fas fa-ticket-alt",
            searchTerms: [ "ticket" ]
        }, {
            title: "fas fa-times",
            searchTerms: [ "close", "cross", "error", "exit", "incorrect", "notice", "notification", "notify", "problem", "wrong", "x" ]
        }, {
            title: "fas fa-times-circle",
            searchTerms: [ "close", "cross", "exit", "incorrect", "notice", "notification", "notify", "problem", "wrong", "x" ]
        }, {
            title: "far fa-times-circle",
            searchTerms: [ "close", "cross", "exit", "incorrect", "notice", "notification", "notify", "problem", "wrong", "x" ]
        }, {
            title: "fas fa-tint",
            searchTerms: [ "drop", "droplet", "raindrop", "waterdrop" ]
        }, {
            title: "fas fa-tint-slash",
            searchTerms: []
        }, {
            title: "fas fa-tired",
            searchTerms: [ "emoticon", "face", "grumpy" ]
        }, {
            title: "far fa-tired",
            searchTerms: [ "emoticon", "face", "grumpy" ]
        }, {
            title: "fas fa-toggle-off",
            searchTerms: [ "switch" ]
        }, {
            title: "fas fa-toggle-on",
            searchTerms: [ "switch" ]
        }, {
            title: "fas fa-toilet-paper",
            searchTerms: [ "bathroom", "halloween", "holiday", "lavatory", "prank", "restroom", "roll" ]
        }, {
            title: "fas fa-toolbox",
            searchTerms: [ "admin", "container", "fix", "repair", "settings", "tools" ]
        }, {
            title: "fas fa-tooth",
            searchTerms: [ "bicuspid", "dental", "molar", "mouth", "teeth" ]
        }, {
            title: "fas fa-torah",
            searchTerms: [ "book", "jewish", "judaism" ]
        }, {
            title: "fas fa-torii-gate",
            searchTerms: [ "building", "shintoism" ]
        }, {
            title: "fas fa-tractor",
            searchTerms: []
        }, {
            title: "fab fa-trade-federation",
            searchTerms: []
        }, {
            title: "fas fa-trademark",
            searchTerms: []
        }, {
            title: "fas fa-traffic-light",
            searchTerms: []
        }, {
            title: "fas fa-train",
            searchTerms: [ "bullet", "locomotive", "railway" ]
        }, {
            title: "fas fa-transgender",
            searchTerms: [ "intersex" ]
        }, {
            title: "fas fa-transgender-alt",
            searchTerms: []
        }, {
            title: "fas fa-trash",
            searchTerms: [ "delete", "garbage", "hide", "remove" ]
        }, {
            title: "fas fa-trash-alt",
            searchTerms: [ "delete", "garbage", "hide", "remove", "trash", "trash-o" ]
        }, {
            title: "far fa-trash-alt",
            searchTerms: [ "delete", "garbage", "hide", "remove", "trash", "trash-o" ]
        }, {
            title: "fas fa-tree",
            searchTerms: [ "bark", "fall", "flora", "forest", "nature", "plant", "seasonal" ]
        }, {
            title: "fab fa-trello",
            searchTerms: []
        }, {
            title: "fab fa-tripadvisor",
            searchTerms: []
        }, {
            title: "fas fa-trophy",
            searchTerms: [ "achievement", "award", "cup", "game", "winner" ]
        }, {
            title: "fas fa-truck",
            searchTerms: [ "delivery", "shipping" ]
        }, {
            title: "fas fa-truck-loading",
            searchTerms: []
        }, {
            title: "fas fa-truck-monster",
            searchTerms: []
        }, {
            title: "fas fa-truck-moving",
            searchTerms: []
        }, {
            title: "fas fa-truck-pickup",
            searchTerms: []
        }, {
            title: "fas fa-tshirt",
            searchTerms: [ "cloth", "clothing" ]
        }, {
            title: "fas fa-tty",
            searchTerms: []
        }, {
            title: "fab fa-tumblr",
            searchTerms: []
        }, {
            title: "fab fa-tumblr-square",
            searchTerms: []
        }, {
            title: "fas fa-tv",
            searchTerms: [ "computer", "display", "monitor", "television" ]
        }, {
            title: "fab fa-twitch",
            searchTerms: []
        }, {
            title: "fab fa-twitter",
            searchTerms: [ "social network", "tweet" ]
        }, {
            title: "fab fa-twitter-square",
            searchTerms: [ "social network", "tweet" ]
        }, {
            title: "fab fa-typo3",
            searchTerms: []
        }, {
            title: "fab fa-uber",
            searchTerms: []
        }, {
            title: "fab fa-uikit",
            searchTerms: []
        }, {
            title: "fas fa-umbrella",
            searchTerms: [ "protection", "rain" ]
        }, {
            title: "fas fa-umbrella-beach",
            searchTerms: [ "protection", "recreation", "sun" ]
        }, {
            title: "fas fa-underline",
            searchTerms: []
        }, {
            title: "fas fa-undo",
            searchTerms: [ "back", "control z", "exchange", "oops", "return", "rotate", "swap" ]
        }, {
            title: "fas fa-undo-alt",
            searchTerms: [ "back", "control z", "exchange", "oops", "return", "swap" ]
        }, {
            title: "fab fa-uniregistry",
            searchTerms: []
        }, {
            title: "fas fa-universal-access",
            searchTerms: []
        }, {
            title: "fas fa-university",
            searchTerms: [ "bank", "institution" ]
        }, {
            title: "fas fa-unlink",
            searchTerms: [ "chain", "chain-broken", "remove" ]
        }, {
            title: "fas fa-unlock",
            searchTerms: [ "admin", "lock", "password", "protect" ]
        }, {
            title: "fas fa-unlock-alt",
            searchTerms: [ "admin", "lock", "password", "protect" ]
        }, {
            title: "fab fa-untappd",
            searchTerms: []
        }, {
            title: "fas fa-upload",
            searchTerms: [ "export", "publish" ]
        }, {
            title: "fab fa-usb",
            searchTerms: []
        }, {
            title: "fas fa-user",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "far fa-user",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "fas fa-user-alt",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "fas fa-user-alt-slash",
            searchTerms: []
        }, {
            title: "fas fa-user-astronaut",
            searchTerms: [ "avatar", "clothing", "cosmonaut", "space", "suit" ]
        }, {
            title: "fas fa-user-check",
            searchTerms: []
        }, {
            title: "fas fa-user-circle",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "far fa-user-circle",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "fas fa-user-clock",
            searchTerms: []
        }, {
            title: "fas fa-user-cog",
            searchTerms: []
        }, {
            title: "fas fa-user-edit",
            searchTerms: []
        }, {
            title: "fas fa-user-friends",
            searchTerms: []
        }, {
            title: "fas fa-user-graduate",
            searchTerms: [ "cap", "clothing", "commencement", "gown", "graduation", "student" ]
        }, {
            title: "fas fa-user-injured",
            searchTerms: [ "cast", "ouch", "sling" ]
        }, {
            title: "fas fa-user-lock",
            searchTerms: []
        }, {
            title: "fas fa-user-md",
            searchTerms: [ "doctor", "job", "medical", "nurse", "occupation", "profile" ]
        }, {
            title: "fas fa-user-minus",
            searchTerms: [ "delete", "negative", "remove" ]
        }, {
            title: "fas fa-user-ninja",
            searchTerms: [ "assassin", "avatar", "dangerous", "deadly", "sneaky" ]
        }, {
            title: "fas fa-user-plus",
            searchTerms: [ "positive", "sign up", "signup" ]
        }, {
            title: "fas fa-user-secret",
            searchTerms: [ "clothing", "coat", "hat", "incognito", "privacy", "spy", "whisper" ]
        }, {
            title: "fas fa-user-shield",
            searchTerms: []
        }, {
            title: "fas fa-user-slash",
            searchTerms: [ "ban", "remove" ]
        }, {
            title: "fas fa-user-tag",
            searchTerms: []
        }, {
            title: "fas fa-user-tie",
            searchTerms: [ "avatar", "business", "clothing", "formal" ]
        }, {
            title: "fas fa-user-times",
            searchTerms: [ "archive", "delete", "remove", "x" ]
        }, {
            title: "fas fa-users",
            searchTerms: [ "people", "persons", "profiles" ]
        }, {
            title: "fas fa-users-cog",
            searchTerms: []
        }, {
            title: "fab fa-ussunnah",
            searchTerms: []
        }, {
            title: "fas fa-utensil-spoon",
            searchTerms: [ "spoon" ]
        }, {
            title: "fas fa-utensils",
            searchTerms: [ "cutlery", "dinner", "eat", "food", "knife", "restaurant", "spoon" ]
        }, {
            title: "fab fa-vaadin",
            searchTerms: []
        }, {
            title: "fas fa-vector-square",
            searchTerms: [ "anchors", "lines", "object" ]
        }, {
            title: "fas fa-venus",
            searchTerms: [ "female" ]
        }, {
            title: "fas fa-venus-double",
            searchTerms: []
        }, {
            title: "fas fa-venus-mars",
            searchTerms: []
        }, {
            title: "fab fa-viacoin",
            searchTerms: []
        }, {
            title: "fab fa-viadeo",
            searchTerms: []
        }, {
            title: "fab fa-viadeo-square",
            searchTerms: []
        }, {
            title: "fas fa-vial",
            searchTerms: [ "test tube" ]
        }, {
            title: "fas fa-vials",
            searchTerms: [ "lab results", "test tubes" ]
        }, {
            title: "fab fa-viber",
            searchTerms: []
        }, {
            title: "fas fa-video",
            searchTerms: [ "camera", "film", "movie", "record", "video-camera" ]
        }, {
            title: "fas fa-video-slash",
            searchTerms: []
        }, {
            title: "fas fa-vihara",
            searchTerms: [ "buddhism", "buddhist", "building", "monastery" ]
        }, {
            title: "fab fa-vimeo",
            searchTerms: []
        }, {
            title: "fab fa-vimeo-square",
            searchTerms: []
        }, {
            title: "fab fa-vimeo-v",
            searchTerms: [ "vimeo" ]
        }, {
            title: "fab fa-vine",
            searchTerms: []
        }, {
            title: "fab fa-vk",
            searchTerms: []
        }, {
            title: "fab fa-vnv",
            searchTerms: []
        }, {
            title: "fas fa-volleyball-ball",
            searchTerms: []
        }, {
            title: "fas fa-volume-down",
            searchTerms: [ "audio", "lower", "music", "quieter", "sound", "speaker" ]
        }, {
            title: "fas fa-volume-mute",
            searchTerms: []
        }, {
            title: "fas fa-volume-off",
            searchTerms: [ "audio", "music", "mute", "sound" ]
        }, {
            title: "fas fa-volume-up",
            searchTerms: [ "audio", "higher", "louder", "music", "sound", "speaker" ]
        }, {
            title: "fas fa-vote-yea",
            searchTerms: [ "accept", "cast", "election", "politics", "positive", "yes" ]
        }, {
            title: "fas fa-vr-cardboard",
            searchTerms: [ "google", "reality", "virtual" ]
        }, {
            title: "fab fa-vuejs",
            searchTerms: []
        }, {
            title: "fas fa-walking",
            searchTerms: []
        }, {
            title: "fas fa-wallet",
            searchTerms: []
        }, {
            title: "fas fa-warehouse",
            searchTerms: []
        }, {
            title: "fas fa-water",
            searchTerms: []
        }, {
            title: "fab fa-weebly",
            searchTerms: []
        }, {
            title: "fab fa-weibo",
            searchTerms: []
        }, {
            title: "fas fa-weight",
            searchTerms: [ "measurement", "scale", "weight" ]
        }, {
            title: "fas fa-weight-hanging",
            searchTerms: [ "anvil", "heavy", "measurement" ]
        }, {
            title: "fab fa-weixin",
            searchTerms: []
        }, {
            title: "fab fa-whatsapp",
            searchTerms: []
        }, {
            title: "fab fa-whatsapp-square",
            searchTerms: []
        }, {
            title: "fas fa-wheelchair",
            searchTerms: [ "handicap", "person" ]
        }, {
            title: "fab fa-whmcs",
            searchTerms: []
        }, {
            title: "fas fa-wifi",
            searchTerms: []
        }, {
            title: "fab fa-wikipedia-w",
            searchTerms: []
        }, {
            title: "fas fa-wind",
            searchTerms: [ "air", "blow", "breeze", "fall", "seasonal" ]
        }, {
            title: "fas fa-window-close",
            searchTerms: []
        }, {
            title: "far fa-window-close",
            searchTerms: []
        }, {
            title: "fas fa-window-maximize",
            searchTerms: []
        }, {
            title: "far fa-window-maximize",
            searchTerms: []
        }, {
            title: "fas fa-window-minimize",
            searchTerms: []
        }, {
            title: "far fa-window-minimize",
            searchTerms: []
        }, {
            title: "fas fa-window-restore",
            searchTerms: []
        }, {
            title: "far fa-window-restore",
            searchTerms: []
        }, {
            title: "fab fa-windows",
            searchTerms: [ "microsoft" ]
        }, {
            title: "fas fa-wine-bottle",
            searchTerms: [ "alcohol", "beverage", "drink", "glass", "grapes" ]
        }, {
            title: "fas fa-wine-glass",
            searchTerms: [ "alcohol", "beverage", "drink", "grapes" ]
        }, {
            title: "fas fa-wine-glass-alt",
            searchTerms: [ "alcohol", "beverage", "drink", "grapes" ]
        }, {
            title: "fab fa-wix",
            searchTerms: []
        }, {
            title: "fab fa-wizards-of-the-coast",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "game", "gaming", "tabletop" ]
        }, {
            title: "fab fa-wolf-pack-battalion",
            searchTerms: []
        }, {
            title: "fas fa-won-sign",
            searchTerms: [ "krw" ]
        }, {
            title: "fab fa-wordpress",
            searchTerms: []
        }, {
            title: "fab fa-wordpress-simple",
            searchTerms: []
        }, {
            title: "fab fa-wpbeginner",
            searchTerms: []
        }, {
            title: "fab fa-wpexplorer",
            searchTerms: []
        }, {
            title: "fab fa-wpforms",
            searchTerms: []
        }, {
            title: "fab fa-wpressr",
            searchTerms: [ "rendact" ]
        }, {
            title: "fas fa-wrench",
            searchTerms: [ "fix", "settings", "spanner", "tool", "update" ]
        }, {
            title: "fas fa-x-ray",
            searchTerms: [ "radiological images", "radiology" ]
        }, {
            title: "fab fa-xbox",
            searchTerms: []
        }, {
            title: "fab fa-xing",
            searchTerms: []
        }, {
            title: "fab fa-xing-square",
            searchTerms: []
        }, {
            title: "fab fa-y-combinator",
            searchTerms: []
        }, {
            title: "fab fa-yahoo",
            searchTerms: []
        }, {
            title: "fab fa-yandex",
            searchTerms: []
        }, {
            title: "fab fa-yandex-international",
            searchTerms: []
        }, {
            title: "fab fa-yelp",
            searchTerms: []
        }, {
            title: "fas fa-yen-sign",
            searchTerms: [ "jpy", "money" ]
        }, {
            title: "fas fa-yin-yang",
            searchTerms: [ "daoism", "opposites", "taoism" ]
        }, {
            title: "fab fa-yoast",
            searchTerms: []
        }, {
            title: "fab fa-youtube",
            searchTerms: [ "film", "video", "youtube-play", "youtube-square" ]
        }, {
            title: "fab fa-youtube-square",
            searchTerms: []
        }, {
            title: "fab fa-zhihu",
            searchTerms: []
        },
        {
            title: "lab la-500px",
            searchTerms: []
        }, {
            title: "lab la-accessible-icon",
            searchTerms: [ "accessibility", "handicap", "person", "wheelchair", "wheelchair-alt" ]
        }, {
            title: "lab la-accusoft",
            searchTerms: []
        }, {
            title: "las la-ad",
            searchTerms: []
        }, {
            title: "las la-address-book",
            searchTerms: []
        }, {
            title: "lar la-address-book",
            searchTerms: []
        }, {
            title: "las la-address-card",
            searchTerms: []
        }, {
            title: "lar la-address-card",
            searchTerms: []
        }, {
            title: "las la-adjust",
            searchTerms: [ "contrast" ]
        }, {
            title: "lab la-adn",
            searchTerms: []
        }, {
            title: "lab la-adversal",
            searchTerms: []
        }, {
            title: "lab la-affiliatetheme",
            searchTerms: []
        }, {
            title: "las la-air-freshener",
            searchTerms: []
        }, {
            title: "lab la-algolia",
            searchTerms: []
        }, {
            title: "las la-align-center",
            searchTerms: [ "middle", "text" ]
        }, {
            title: "las la-align-justify",
            searchTerms: [ "text" ]
        }, {
            title: "las la-align-left",
            searchTerms: [ "text" ]
        }, {
            title: "las la-align-right",
            searchTerms: [ "text" ]
        }, {
            title: "lab la-alipay",
            searchTerms: []
        }, {
            title: "las la-allergies",
            searchTerms: [ "freckles", "hand", "intolerances", "pox", "spots" ]
        }, {
            title: "lab la-amazon",
            searchTerms: []
        }, {
            title: "lab la-amazon-pay",
            searchTerms: []
        }, {
            title: "las la-ambulance",
            searchTerms: [ "help", "machine", "support", "vehicle" ]
        }, {
            title: "las la-american-sign-language-interpreting",
            searchTerms: []
        }, {
            title: "lab la-amilia",
            searchTerms: []
        }, {
            title: "las la-anchor",
            searchTerms: [ "link" ]
        }, {
            title: "lab la-android",
            searchTerms: [ "robot" ]
        }, {
            title: "lab la-angellist",
            searchTerms: []
        }, {
            title: "las la-angle-double-down",
            searchTerms: [ "arrows" ]
        }, {
            title: "las la-angle-double-left",
            searchTerms: [ "arrows", "back", "laquo", "previous", "quote" ]
        }, {
            title: "las la-angle-double-right",
            searchTerms: [ "arrows", "forward", "next", "quote", "raquo" ]
        }, {
            title: "las la-angle-double-up",
            searchTerms: [ "arrows" ]
        }, {
            title: "las la-angle-down",
            searchTerms: [ "arrow" ]
        }, {
            title: "las la-angle-left",
            searchTerms: [ "arrow", "back", "previous" ]
        }, {
            title: "las la-angle-right",
            searchTerms: [ "arrow", "forward", "next" ]
        }, {
            title: "las la-angle-up",
            searchTerms: [ "arrow" ]
        }, {
            title: "las la-angry",
            searchTerms: [ "disapprove", "emoticon", "face", "mad", "upset" ]
        }, {
            title: "lar la-angry",
            searchTerms: [ "disapprove", "emoticon", "face", "mad", "upset" ]
        }, {
            title: "lab la-angrycreative",
            searchTerms: []
        }, {
            title: "lab la-angular",
            searchTerms: []
        }, {
            title: "las la-ankh",
            searchTerms: [ "amulet", "copper", "coptic christianity", "copts", "crux ansata", "egyptian", "venus" ]
        }, {
            title: "lab la-app-store",
            searchTerms: []
        }, {
            title: "lab la-app-store-ios",
            searchTerms: []
        }, {
            title: "lab la-apper",
            searchTerms: []
        }, {
            title: "lab la-apple",
            searchTerms: [ "food", "fruit", "mac", "osx" ]
        }, {
            title: "las la-apple-alt",
            searchTerms: [ "fall", "food", "fruit", "fuji", "macintosh", "seasonal" ]
        }, {
            title: "lab la-apple-pay",
            searchTerms: []
        }, {
            title: "las la-archive",
            searchTerms: [ "box", "package", "storage" ]
        }, {
            title: "las la-archway",
            searchTerms: [ "arc", "monument", "road", "street" ]
        }, {
            title: "las la-arrow-alt-circle-down",
            searchTerms: [ "arrow-circle-o-down", "download" ]
        }, {
            title: "lar la-arrow-alt-circle-down",
            searchTerms: [ "arrow-circle-o-down", "download" ]
        }, {
            title: "las la-arrow-alt-circle-left",
            searchTerms: [ "arrow-circle-o-left", "back", "previous" ]
        }, {
            title: "lar la-arrow-alt-circle-left",
            searchTerms: [ "arrow-circle-o-left", "back", "previous" ]
        }, {
            title: "las la-arrow-alt-circle-right",
            searchTerms: [ "arrow-circle-o-right", "forward", "next" ]
        }, {
            title: "lar la-arrow-alt-circle-right",
            searchTerms: [ "arrow-circle-o-right", "forward", "next" ]
        }, {
            title: "las la-arrow-alt-circle-up",
            searchTerms: [ "arrow-circle-o-up" ]
        }, {
            title: "lar la-arrow-alt-circle-up",
            searchTerms: [ "arrow-circle-o-up" ]
        }, {
            title: "las la-arrow-circle-down",
            searchTerms: [ "download" ]
        }, {
            title: "las la-arrow-circle-left",
            searchTerms: [ "back", "previous" ]
        }, {
            title: "las la-arrow-circle-right",
            searchTerms: [ "forward", "next" ]
        }, {
            title: "las la-arrow-circle-up",
            searchTerms: []
        }, {
            title: "las la-arrow-down",
            searchTerms: [ "download" ]
        }, {
            title: "las la-arrow-left",
            searchTerms: [ "back", "previous" ]
        }, {
            title: "las la-arrow-right",
            searchTerms: [ "forward", "next" ]
        }, {
            title: "las la-arrow-up",
            searchTerms: []
        }, {
            title: "las la-arrows-alt",
            searchTerms: [ "arrow", "arrows", "bigger", "enlarge", "expand", "fullscreen", "move", "position", "reorder", "resize" ]
        }, {
            title: "las la-arrows-alt-h",
            searchTerms: [ "arrows-h", "resize" ]
        }, {
            title: "las la-arrows-alt-v",
            searchTerms: [ "arrows-v", "resize" ]
        }, {
            title: "las la-assistive-listening-systems",
            searchTerms: []
        }, {
            title: "las la-asterisk",
            searchTerms: [ "details" ]
        }, {
            title: "lab la-asymmetrik",
            searchTerms: []
        }, {
            title: "las la-at",
            searchTerms: [ "e-mail", "email" ]
        }, {
            title: "las la-atlas",
            searchTerms: [ "book", "directions", "geography", "map", "wayfinding" ]
        }, {
            title: "las la-atom",
            searchTerms: [ "atheism", "chemistry", "science" ]
        }, {
            title: "lab la-audible",
            searchTerms: []
        }, {
            title: "las la-audio-description",
            searchTerms: []
        }, {
            title: "lab la-autoprefixer",
            searchTerms: []
        }, {
            title: "lab la-avianex",
            searchTerms: []
        }, {
            title: "lab la-aviato",
            searchTerms: []
        }, {
            title: "las la-award",
            searchTerms: [ "honor", "praise", "prize", "recognition", "ribbon" ]
        }, {
            title: "lab la-aws",
            searchTerms: []
        }, {
            title: "las la-backspace",
            searchTerms: [ "command", "delete", "keyboard", "undo" ]
        }, {
            title: "las la-backward",
            searchTerms: [ "previous", "rewind" ]
        }, {
            title: "las la-balance-scale",
            searchTerms: [ "balanced", "justice", "legal", "measure", "weight" ]
        }, {
            title: "las la-ban",
            searchTerms: [ "abort", "ban", "block", "cancel", "delete", "hide", "prohibit", "remove", "stop", "trash" ]
        }, {
            title: "las la-band-aid",
            searchTerms: [ "bandage", "boo boo", "ouch" ]
        }, {
            title: "lab la-bandcamp",
            searchTerms: []
        }, {
            title: "las la-barcode",
            searchTerms: [ "scan" ]
        }, {
            title: "las la-bars",
            searchTerms: [ "checklist", "drag", "hamburger", "list", "menu", "nav", "navigation", "ol", "reorder", "settings", "todo", "ul" ]
        }, {
            title: "las la-baseball-ball",
            searchTerms: []
        }, {
            title: "las la-basketball-ball",
            searchTerms: []
        }, {
            title: "las la-bath",
            searchTerms: []
        }, {
            title: "las la-battery-empty",
            searchTerms: [ "power", "status" ]
        }, {
            title: "las la-battery-full",
            searchTerms: [ "power", "status" ]
        }, {
            title: "las la-battery-half",
            searchTerms: [ "power", "status" ]
        }, {
            title: "las la-battery-quarter",
            searchTerms: [ "power", "status" ]
        }, {
            title: "las la-battery-three-quarters",
            searchTerms: [ "power", "status" ]
        }, {
            title: "las la-bed",
            searchTerms: [ "lodging", "sleep", "travel" ]
        }, {
            title: "las la-beer",
            searchTerms: [ "alcohol", "bar", "beverage", "drink", "liquor", "mug", "stein" ]
        }, {
            title: "lab la-behance",
            searchTerms: []
        }, {
            title: "lab la-behance-square",
            searchTerms: []
        }, {
            title: "las la-bell",
            searchTerms: [ "alert", "notification", "reminder" ]
        }, {
            title: "lar la-bell",
            searchTerms: [ "alert", "notification", "reminder" ]
        }, {
            title: "las la-bell-slash",
            searchTerms: []
        }, {
            title: "lar la-bell-slash",
            searchTerms: []
        }, {
            title: "las la-bezier-curve",
            searchTerms: [ "curves", "illustrator", "lines", "path", "vector" ]
        }, {
            title: "las la-bible",
            searchTerms: [ "book", "catholicism", "christianity" ]
        }, {
            title: "las la-bicycle",
            searchTerms: [ "bike", "gears", "transportation", "vehicle" ]
        }, {
            title: "lab la-bimobject",
            searchTerms: []
        }, {
            title: "las la-binoculars",
            searchTerms: []
        }, {
            title: "las la-birthday-cake",
            searchTerms: []
        }, {
            title: "lab la-bitbucket",
            searchTerms: [ "bitbucket-square", "git" ]
        }, {
            title: "lab la-bitcoin",
            searchTerms: []
        }, {
            title: "lab la-bity",
            searchTerms: []
        }, {
            title: "lab la-black-tie",
            searchTerms: []
        }, {
            title: "lab la-blackberry",
            searchTerms: []
        }, {
            title: "las la-blender",
            searchTerms: []
        }, {
            title: "las la-blender-phone",
            searchTerms: [ "appliance", "fantasy", "silly" ]
        }, {
            title: "las la-blind",
            searchTerms: []
        }, {
            title: "lab la-blogger",
            searchTerms: []
        }, {
            title: "lab la-blogger-b",
            searchTerms: []
        }, {
            title: "lab la-bluetooth",
            searchTerms: []
        }, {
            title: "lab la-bluetooth-b",
            searchTerms: []
        }, {
            title: "las la-bold",
            searchTerms: []
        }, {
            title: "las la-bolt",
            searchTerms: [ "electricity", "lightning", "weather", "zap" ]
        }, {
            title: "las la-bomb",
            searchTerms: []
        }, {
            title: "las la-bone",
            searchTerms: []
        }, {
            title: "las la-bong",
            searchTerms: [ "aparatus", "cannabis", "marijuana", "pipe", "smoke", "smoking" ]
        }, {
            title: "las la-book",
            searchTerms: [ "documentation", "read" ]
        }, {
            title: "las la-book-dead",
            searchTerms: [ "Dungeons & Dragons", "crossbones", "d&d", "dark arts", "death", "dnd", "documentation", "evil", "fantasy", "halloween", "holiday", "read", "skull", "spell" ]
        }, {
            title: "las la-book-open",
            searchTerms: [ "flyer", "notebook", "open book", "pamphlet", "reading" ]
        }, {
            title: "las la-book-reader",
            searchTerms: [ "library" ]
        }, {
            title: "las la-bookmark",
            searchTerms: [ "save" ]
        }, {
            title: "lar la-bookmark",
            searchTerms: [ "save" ]
        }, {
            title: "las la-bowling-ball",
            searchTerms: []
        }, {
            title: "las la-box",
            searchTerms: [ "package" ]
        }, {
            title: "las la-box-open",
            searchTerms: []
        }, {
            title: "las la-boxes",
            searchTerms: []
        }, {
            title: "las la-braille",
            searchTerms: []
        }, {
            title: "las la-brain",
            searchTerms: [ "cerebellum", "gray matter", "intellect", "medulla oblongata", "mind", "noodle", "wit" ]
        }, {
            title: "las la-briefcase",
            searchTerms: [ "bag", "business", "luggage", "office", "work" ]
        }, {
            title: "las la-briefcase-medical",
            searchTerms: [ "health briefcase" ]
        }, {
            title: "las la-broadcast-tower",
            searchTerms: [ "airwaves", "radio", "waves" ]
        }, {
            title: "las la-broom",
            searchTerms: [ "clean", "firebolt", "fly", "halloween", "holiday", "nimbus 2000", "quidditch", "sweep", "witch" ]
        }, {
            title: "las la-brush",
            searchTerms: [ "bristles", "color", "handle", "painting" ]
        }, {
            title: "lab la-btc",
            searchTerms: []
        }, {
            title: "las la-bug",
            searchTerms: [ "insect", "report" ]
        }, {
            title: "las la-building",
            searchTerms: [ "apartment", "business", "company", "office", "work" ]
        }, {
            title: "lar la-building",
            searchTerms: [ "apartment", "business", "company", "office", "work" ]
        }, {
            title: "las la-bullhorn",
            searchTerms: [ "announcement", "broadcast", "louder", "megaphone", "share" ]
        }, {
            title: "las la-bullseye",
            searchTerms: [ "target" ]
        }, {
            title: "las la-burn",
            searchTerms: [ "energy" ]
        }, {
            title: "lab la-buromobelexperte",
            searchTerms: []
        }, {
            title: "las la-bus",
            searchTerms: [ "machine", "public transportation", "transportation", "vehicle" ]
        }, {
            title: "las la-bus-alt",
            searchTerms: [ "machine", "public transportation", "transportation", "vehicle" ]
        }, {
            title: "las la-business-time",
            searchTerms: [ "briefcase", "business socks", "clock", "flight of the conchords", "wednesday" ]
        }, {
            title: "lab la-buysellads",
            searchTerms: []
        }, {
            title: "las la-calculator",
            searchTerms: []
        }, {
            title: "las la-calendar",
            searchTerms: [ "calendar-o", "date", "event", "schedule", "time", "when" ]
        }, {
            title: "lar la-calendar",
            searchTerms: [ "calendar-o", "date", "event", "schedule", "time", "when" ]
        }, {
            title: "las la-calendar-alt",
            searchTerms: [ "calendar", "date", "event", "schedule", "time", "when" ]
        }, {
            title: "lar la-calendar-alt",
            searchTerms: [ "calendar", "date", "event", "schedule", "time", "when" ]
        }, {
            title: "las la-calendar-check",
            searchTerms: [ "accept", "agree", "appointment", "confirm", "correct", "done", "ok", "select", "success", "todo" ]
        }, {
            title: "lar la-calendar-check",
            searchTerms: [ "accept", "agree", "appointment", "confirm", "correct", "done", "ok", "select", "success", "todo" ]
        }, {
            title: "las la-calendar-minus",
            searchTerms: [ "delete", "negative", "remove" ]
        }, {
            title: "lar la-calendar-minus",
            searchTerms: [ "delete", "negative", "remove" ]
        }, {
            title: "las la-calendar-plus",
            searchTerms: [ "add", "create", "new", "positive" ]
        }, {
            title: "lar la-calendar-plus",
            searchTerms: [ "add", "create", "new", "positive" ]
        }, {
            title: "las la-calendar-times",
            searchTerms: [ "archive", "delete", "remove", "x" ]
        }, {
            title: "lar la-calendar-times",
            searchTerms: [ "archive", "delete", "remove", "x" ]
        }, {
            title: "las la-camera",
            searchTerms: [ "photo", "picture", "record" ]
        }, {
            title: "las la-camera-retro",
            searchTerms: [ "photo", "picture", "record" ]
        }, {
            title: "las la-campground",
            searchTerms: [ "camping", "fall", "outdoors", "seasonal", "tent" ]
        }, {
            title: "las la-cannabis",
            searchTerms: [ "bud", "chronic", "drugs", "endica", "endo", "ganja", "marijuana", "mary jane", "pot", "reefer", "sativa", "spliff", "weed", "whacky-tabacky" ]
        }, {
            title: "las la-capsules",
            searchTerms: [ "drugs", "medicine" ]
        }, {
            title: "las la-car",
            searchTerms: [ "machine", "transportation", "vehicle" ]
        }, {
            title: "las la-car-alt",
            searchTerms: []
        }, {
            title: "las la-car-battery",
            searchTerms: []
        }, {
            title: "las la-car-crash",
            searchTerms: []
        }, {
            title: "las la-car-side",
            searchTerms: []
        }, {
            title: "las la-caret-down",
            searchTerms: [ "arrow", "dropdown", "menu", "more", "triangle down" ]
        }, {
            title: "las la-caret-left",
            searchTerms: [ "arrow", "back", "previous", "triangle left" ]
        }, {
            title: "las la-caret-right",
            searchTerms: [ "arrow", "forward", "next", "triangle right" ]
        }, {
            title: "las la-caret-square-down",
            searchTerms: [ "caret-square-o-down", "dropdown", "menu", "more" ]
        }, {
            title: "lar la-caret-square-down",
            searchTerms: [ "caret-square-o-down", "dropdown", "menu", "more" ]
        }, {
            title: "las la-caret-square-left",
            searchTerms: [ "back", "caret-square-o-left", "previous" ]
        }, {
            title: "lar la-caret-square-left",
            searchTerms: [ "back", "caret-square-o-left", "previous" ]
        }, {
            title: "las la-caret-square-right",
            searchTerms: [ "caret-square-o-right", "forward", "next" ]
        }, {
            title: "lar la-caret-square-right",
            searchTerms: [ "caret-square-o-right", "forward", "next" ]
        }, {
            title: "las la-caret-square-up",
            searchTerms: [ "caret-square-o-up" ]
        }, {
            title: "lar la-caret-square-up",
            searchTerms: [ "caret-square-o-up" ]
        }, {
            title: "las la-caret-up",
            searchTerms: [ "arrow", "triangle up" ]
        }, {
            title: "las la-cart-arrow-down",
            searchTerms: [ "shopping" ]
        }, {
            title: "las la-cart-plus",
            searchTerms: [ "add", "create", "new", "positive", "shopping" ]
        }, {
            title: "las la-cat",
            searchTerms: [ "feline", "halloween", "holiday", "kitten", "kitty", "meow", "pet" ]
        }, {
            title: "lab la-cc-amazon-pay",
            searchTerms: []
        }, {
            title: "lab la-cc-amex",
            searchTerms: [ "amex" ]
        }, {
            title: "lab la-cc-apple-pay",
            searchTerms: []
        }, {
            title: "lab la-cc-diners-club",
            searchTerms: []
        }, {
            title: "lab la-cc-discover",
            searchTerms: []
        }, {
            title: "lab la-cc-jcb",
            searchTerms: []
        }, {
            title: "lab la-cc-mastercard",
            searchTerms: []
        }, {
            title: "lab la-cc-paypal",
            searchTerms: []
        }, {
            title: "lab la-cc-stripe",
            searchTerms: []
        }, {
            title: "lab la-cc-visa",
            searchTerms: []
        }, {
            title: "lab la-centercode",
            searchTerms: []
        }, {
            title: "las la-certificate",
            searchTerms: [ "badge", "star" ]
        }, {
            title: "las la-chair",
            searchTerms: [ "furniture", "seat" ]
        }, {
            title: "las la-chalkboard",
            searchTerms: [ "blackboard", "learning", "school", "teaching", "whiteboard", "writing" ]
        }, {
            title: "las la-chalkboard-teacher",
            searchTerms: [ "blackboard", "instructor", "learning", "professor", "school", "whiteboard", "writing" ]
        }, {
            title: "las la-charging-station",
            searchTerms: []
        }, {
            title: "las la-chart-area",
            searchTerms: [ "analytics", "area-chart", "graph" ]
        }, {
            title: "las la-chart-bar",
            searchTerms: [ "analytics", "bar-chart", "graph" ]
        }, {
            title: "lar la-chart-bar",
            searchTerms: [ "analytics", "bar-chart", "graph" ]
        }, {
            title: "las la-chart-line",
            searchTerms: [ "activity", "analytics", "dashboard", "graph", "line-chart" ]
        }, {
            title: "las la-chart-pie",
            searchTerms: [ "analytics", "graph", "pie-chart" ]
        }, {
            title: "las la-check",
            searchTerms: [ "accept", "agree", "checkmark", "confirm", "correct", "done", "notice", "notification", "notify", "ok", "select", "success", "tick", "todo", "yes" ]
        }, {
            title: "las la-check-circle",
            searchTerms: [ "accept", "agree", "confirm", "correct", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "lar la-check-circle",
            searchTerms: [ "accept", "agree", "confirm", "correct", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "las la-check-double",
            searchTerms: [ "accept", "agree", "checkmark", "confirm", "correct", "done", "notice", "notification", "notify", "ok", "select", "success", "tick", "todo" ]
        }, {
            title: "las la-check-square",
            searchTerms: [ "accept", "agree", "checkmark", "confirm", "correct", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "lar la-check-square",
            searchTerms: [ "accept", "agree", "checkmark", "confirm", "correct", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "las la-chess",
            searchTerms: []
        }, {
            title: "las la-chess-bishop",
            searchTerms: []
        }, {
            title: "las la-chess-board",
            searchTerms: []
        }, {
            title: "las la-chess-king",
            searchTerms: []
        }, {
            title: "las la-chess-knight",
            searchTerms: []
        }, {
            title: "las la-chess-pawn",
            searchTerms: []
        }, {
            title: "las la-chess-queen",
            searchTerms: []
        }, {
            title: "las la-chess-rook",
            searchTerms: []
        }, {
            title: "las la-chevron-circle-down",
            searchTerms: [ "arrow", "dropdown", "menu", "more" ]
        }, {
            title: "las la-chevron-circle-left",
            searchTerms: [ "arrow", "back", "previous" ]
        }, {
            title: "las la-chevron-circle-right",
            searchTerms: [ "arrow", "forward", "next" ]
        }, {
            title: "las la-chevron-circle-up",
            searchTerms: [ "arrow" ]
        }, {
            title: "las la-chevron-down",
            searchTerms: []
        }, {
            title: "las la-chevron-left",
            searchTerms: [ "back", "bracket", "previous" ]
        }, {
            title: "las la-chevron-right",
            searchTerms: [ "bracket", "forward", "next" ]
        }, {
            title: "las la-chevron-up",
            searchTerms: []
        }, {
            title: "las la-child",
            searchTerms: []
        }, {
            title: "lab la-chrome",
            searchTerms: [ "browser" ]
        }, {
            title: "las la-church",
            searchTerms: [ "building", "community", "religion" ]
        }, {
            title: "las la-circle",
            searchTerms: [ "circle-thin", "dot", "notification" ]
        }, {
            title: "lar la-circle",
            searchTerms: [ "circle-thin", "dot", "notification" ]
        }, {
            title: "las la-circle-notch",
            searchTerms: [ "circle-o-notch" ]
        }, {
            title: "las la-city",
            searchTerms: [ "buildings", "busy", "skyscrapers", "urban", "windows" ]
        }, {
            title: "las la-clipboard",
            searchTerms: [ "paste" ]
        }, {
            title: "lar la-clipboard",
            searchTerms: [ "paste" ]
        }, {
            title: "las la-clipboard-check",
            searchTerms: [ "accept", "agree", "confirm", "done", "ok", "select", "success", "todo", "yes" ]
        }, {
            title: "las la-clipboard-list",
            searchTerms: [ "checklist", "completed", "done", "finished", "intinerary", "ol", "schedule", "todo", "ul" ]
        }, {
            title: "las la-clock",
            searchTerms: [ "date", "late", "schedule", "timer", "timestamp", "watch" ]
        }, {
            title: "lar la-clock",
            searchTerms: [ "date", "late", "schedule", "timer", "timestamp", "watch" ]
        }, {
            title: "las la-clone",
            searchTerms: [ "copy", "duplicate" ]
        }, {
            title: "lar la-clone",
            searchTerms: [ "copy", "duplicate" ]
        }, {
            title: "las la-closed-captioning",
            searchTerms: [ "cc" ]
        }, {
            title: "lar la-closed-captioning",
            searchTerms: [ "cc" ]
        }, {
            title: "las la-cloud",
            searchTerms: [ "save" ]
        }, {
            title: "las la-cloud-download-alt",
            searchTerms: [ "import" ]
        }, {
            title: "las la-cloud-meatball",
            searchTerms: []
        }, {
            title: "las la-cloud-moon",
            searchTerms: [ "crescent", "evening", "halloween", "holiday", "lunar", "night", "sky" ]
        }, {
            title: "las la-cloud-moon-rain",
            searchTerms: []
        }, {
            title: "las la-cloud-rain",
            searchTerms: [ "precipitation" ]
        }, {
            title: "las la-cloud-showers-heavy",
            searchTerms: [ "precipitation", "rain", "storm" ]
        }, {
            title: "las la-cloud-sun",
            searchTerms: [ "day", "daytime", "fall", "outdoors", "seasonal" ]
        }, {
            title: "las la-cloud-sun-rain",
            searchTerms: []
        }, {
            title: "las la-cloud-upload-alt",
            searchTerms: [ "cloud-upload" ]
        }, {
            title: "lab la-cloudscale",
            searchTerms: []
        }, {
            title: "lab la-cloudsmith",
            searchTerms: []
        }, {
            title: "lab la-cloudversify",
            searchTerms: []
        }, {
            title: "las la-cocktail",
            searchTerms: [ "alcohol", "beverage", "drink" ]
        }, {
            title: "las la-code",
            searchTerms: [ "brackets", "html" ]
        }, {
            title: "las la-code-branch",
            searchTerms: [ "branch", "code-fork", "fork", "git", "github", "rebase", "svn", "vcs", "version" ]
        }, {
            title: "lab la-codepen",
            searchTerms: []
        }, {
            title: "lab la-codiepie",
            searchTerms: []
        }, {
            title: "las la-coffee",
            searchTerms: [ "beverage", "breaklast", "cafe", "drink", "fall", "morning", "mug", "seasonal", "tea" ]
        }, {
            title: "las la-cog",
            searchTerms: [ "settings" ]
        }, {
            title: "las la-cogs",
            searchTerms: [ "gears", "settings" ]
        }, {
            title: "las la-coins",
            searchTerms: []
        }, {
            title: "las la-columns",
            searchTerms: [ "dashboard", "panes", "split" ]
        }, {
            title: "las la-comment",
            searchTerms: [ "bubble", "chat", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "lar la-comment",
            searchTerms: [ "bubble", "chat", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "las la-comment-alt",
            searchTerms: [ "bubble", "chat", "commenting", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "lar la-comment-alt",
            searchTerms: [ "bubble", "chat", "commenting", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "las la-comment-dollar",
            searchTerms: []
        }, {
            title: "las la-comment-dots",
            searchTerms: []
        }, {
            title: "lar la-comment-dots",
            searchTerms: []
        }, {
            title: "las la-comment-slash",
            searchTerms: []
        }, {
            title: "las la-comments",
            searchTerms: [ "bubble", "chat", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "lar la-comments",
            searchTerms: [ "bubble", "chat", "conversation", "feedback", "message", "note", "notification", "sms", "speech", "texting" ]
        }, {
            title: "las la-comments-dollar",
            searchTerms: []
        }, {
            title: "las la-compact-disc",
            searchTerms: [ "bluray", "cd", "disc", "media" ]
        }, {
            title: "las la-compass",
            searchTerms: [ "directory", "location", "menu", "salari" ]
        }, {
            title: "lar la-compass",
            searchTerms: [ "directory", "location", "menu", "salari" ]
        }, {
            title: "las la-compress",
            searchTerms: [ "collapse", "combine", "contract", "merge", "smaller" ]
        }, {
            title: "las la-concierge-bell",
            searchTerms: [ "attention", "hotel", "service", "support" ]
        }, {
            title: "lab la-connectdevelop",
            searchTerms: []
        }, {
            title: "lab la-contao",
            searchTerms: []
        }, {
            title: "las la-cookie",
            searchTerms: [ "baked good", "chips", "food", "snack", "sweet", "treat" ]
        }, {
            title: "las la-cookie-bite",
            searchTerms: [ "baked good", "bitten", "chips", "eating", "food", "snack", "sweet", "treat" ]
        }, {
            title: "las la-copy",
            searchTerms: [ "clone", "duplicate", "file", "files-o" ]
        }, {
            title: "lar la-copy",
            searchTerms: [ "clone", "duplicate", "file", "files-o" ]
        }, {
            title: "las la-copyright",
            searchTerms: []
        }, {
            title: "lar la-copyright",
            searchTerms: []
        }, {
            title: "las la-couch",
            searchTerms: [ "furniture", "sofa" ]
        }, {
            title: "lab la-cpanel",
            searchTerms: []
        }, {
            title: "lab la-creative-commons",
            searchTerms: []
        }, {
            title: "lab la-creative-commons-by",
            searchTerms: []
        }, {
            title: "lab la-creative-commons-nc",
            searchTerms: []
        }, {
            title: "lab la-creative-commons-nc-eu",
            searchTerms: []
        }, {
            title: "lab la-creative-commons-nc-jp",
            searchTerms: []
        }, {
            title: "lab la-creative-commons-nd",
            searchTerms: []
        }, {
            title: "lab la-creative-commons-pd",
            searchTerms: []
        }, {
            title: "lab la-creative-commons-pd-alt",
            searchTerms: []
        }, {
            title: "lab la-creative-commons-remix",
            searchTerms: []
        }, {
            title: "lab la-creative-commons-sa",
            searchTerms: []
        }, {
            title: "lab la-creative-commons-sampling",
            searchTerms: []
        }, {
            title: "lab la-creative-commons-sampling-plus",
            searchTerms: []
        }, {
            title: "lab la-creative-commons-share",
            searchTerms: []
        }, {
            title: "lab la-creative-commons-zero",
            searchTerms: []
        }, {
            title: "las la-credit-card",
            searchTerms: [ "buy", "checkout", "credit-card-alt", "debit", "money", "payment", "purchase" ]
        }, {
            title: "lar la-credit-card",
            searchTerms: [ "buy", "checkout", "credit-card-alt", "debit", "money", "payment", "purchase" ]
        }, {
            title: "lab la-critical-role",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "game", "gaming", "tabletop" ]
        }, {
            title: "las la-crop",
            searchTerms: [ "design" ]
        }, {
            title: "las la-crop-alt",
            searchTerms: []
        }, {
            title: "las la-cross",
            searchTerms: [ "catholicism", "christianity" ]
        }, {
            title: "las la-crosshairs",
            searchTerms: [ "gpd", "picker", "position" ]
        }, {
            title: "las la-crow",
            searchTerms: [ "bird", "bullfrog", "fauna", "halloween", "holiday", "toad" ]
        }, {
            title: "las la-crown",
            searchTerms: []
        }, {
            title: "lab la-css3",
            searchTerms: [ "code" ]
        }, {
            title: "lab la-css3-alt",
            searchTerms: []
        }, {
            title: "las la-cube",
            searchTerms: [ "package" ]
        }, {
            title: "las la-cubes",
            searchTerms: [ "packages" ]
        }, {
            title: "las la-cut",
            searchTerms: [ "scissors" ]
        }, {
            title: "lab la-cuttlefish",
            searchTerms: []
        }, {
            title: "lab la-d-and-d",
            searchTerms: []
        }, {
            title: "lab la-d-and-d-beyond",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "gaming", "tabletop" ]
        }, {
            title: "lab la-dashcube",
            searchTerms: []
        }, {
            title: "las la-database",
            searchTerms: []
        }, {
            title: "las la-deaf",
            searchTerms: []
        }, {
            title: "lab la-delicious",
            searchTerms: []
        }, {
            title: "las la-democrat",
            searchTerms: [ "american", "democratic party", "donkey", "election", "left", "left-wing", "liberal", "politics", "usa" ]
        }, {
            title: "lab la-deploydog",
            searchTerms: []
        }, {
            title: "lab la-deskpro",
            searchTerms: []
        }, {
            title: "las la-desktop",
            searchTerms: [ "computer", "cpu", "demo", "desktop", "device", "machine", "monitor", "pc", "screen" ]
        }, {
            title: "lab la-dev",
            searchTerms: []
        }, {
            title: "lab la-deviantart",
            searchTerms: []
        }, {
            title: "las la-dharmachakra",
            searchTerms: [ "buddhism", "buddhist", "wheel of dharma" ]
        }, {
            title: "las la-diagnoses",
            searchTerms: []
        }, {
            title: "las la-dice",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "las la-dice-d20",
            searchTerms: [ "Dungeons & Dragons", "chance", "d&d", "dnd", "fantasy", "gambling", "game", "roll" ]
        }, {
            title: "las la-dice-d6",
            searchTerms: [ "Dungeons & Dragons", "chance", "d&d", "dnd", "fantasy", "gambling", "game", "roll" ]
        }, {
            title: "las la-dice-five",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "las la-dice-four",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "las la-dice-one",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "las la-dice-six",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "las la-dice-three",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "las la-dice-two",
            searchTerms: [ "chance", "gambling", "game", "roll" ]
        }, {
            title: "lab la-digg",
            searchTerms: []
        }, {
            title: "lab la-digital-ocean",
            searchTerms: []
        }, {
            title: "las la-digital-tachograph",
            searchTerms: []
        }, {
            title: "las la-directions",
            searchTerms: []
        }, {
            title: "lab la-discord",
            searchTerms: []
        }, {
            title: "lab la-discourse",
            searchTerms: []
        }, {
            title: "las la-divide",
            searchTerms: []
        }, {
            title: "las la-dizzy",
            searchTerms: [ "dazed", "disapprove", "emoticon", "face" ]
        }, {
            title: "lar la-dizzy",
            searchTerms: [ "dazed", "disapprove", "emoticon", "face" ]
        }, {
            title: "las la-dna",
            searchTerms: [ "double helix", "helix" ]
        }, {
            title: "lab la-dochub",
            searchTerms: []
        }, {
            title: "lab la-docker",
            searchTerms: []
        }, {
            title: "las la-dog",
            searchTerms: [ "canine", "fauna", "mammmal", "pet", "pooch", "puppy", "woof" ]
        }, {
            title: "las la-dollar-sign",
            searchTerms: [ "$", "dollar-sign", "money", "price", "usd" ]
        }, {
            title: "las la-dolly",
            searchTerms: []
        }, {
            title: "las la-dolly-flatbed",
            searchTerms: []
        }, {
            title: "las la-donate",
            searchTerms: [ "generosity", "give" ]
        }, {
            title: "las la-door-closed",
            searchTerms: []
        }, {
            title: "las la-door-open",
            searchTerms: []
        }, {
            title: "las la-dot-circle",
            searchTerms: [ "bullseye", "notification", "target" ]
        }, {
            title: "lar la-dot-circle",
            searchTerms: [ "bullseye", "notification", "target" ]
        }, {
            title: "las la-dove",
            searchTerms: [ "bird", "fauna", "flying", "peace" ]
        }, {
            title: "las la-download",
            searchTerms: [ "import" ]
        }, {
            title: "lab la-draft2digital",
            searchTerms: []
        }, {
            title: "las la-drafting-compass",
            searchTerms: [ "mechanical drawing", "plot", "plotting" ]
        }, {
            title: "las la-dragon",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy" ]
        }, {
            title: "las la-draw-polygon",
            searchTerms: []
        }, {
            title: "lab la-dribbble",
            searchTerms: []
        }, {
            title: "lab la-dribbble-square",
            searchTerms: []
        }, {
            title: "lab la-dropbox",
            searchTerms: []
        }, {
            title: "las la-drum",
            searchTerms: [ "instrument", "music", "percussion", "snare", "sound" ]
        }, {
            title: "las la-drum-steelpan",
            searchTerms: [ "calypso", "instrument", "music", "percussion", "reggae", "snare", "sound", "steel", "tropical" ]
        }, {
            title: "las la-drumstick-bite",
            searchTerms: []
        }, {
            title: "lab la-drupal",
            searchTerms: []
        }, {
            title: "las la-dumbbell",
            searchTerms: [ "exercise", "gym", "strength", "weight", "weight-lifting" ]
        }, {
            title: "las la-dungeon",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "door", "entrance", "fantasy", "gate" ]
        }, {
            title: "lab la-dyalog",
            searchTerms: []
        }, {
            title: "lab la-earlybirds",
            searchTerms: []
        }, {
            title: "lab la-ebay",
            searchTerms: []
        }, {
            title: "lab la-edge",
            searchTerms: [ "browser", "ie" ]
        }, {
            title: "las la-edit",
            searchTerms: [ "edit", "pen", "pencil", "update", "write" ]
        }, {
            title: "lar la-edit",
            searchTerms: [ "edit", "pen", "pencil", "update", "write" ]
        }, {
            title: "las la-eject",
            searchTerms: []
        }, {
            title: "lab la-elementor",
            searchTerms: []
        }, {
            title: "las la-ellipsis-h",
            searchTerms: [ "dots", "drag", "kebab", "list", "menu", "nav", "navigation", "ol", "reorder", "settings", "ul" ]
        }, {
            title: "las la-ellipsis-v",
            searchTerms: [ "dots", "drag", "kebab", "list", "menu", "nav", "navigation", "ol", "reorder", "settings", "ul" ]
        }, {
            title: "lab la-ello",
            searchTerms: []
        }, {
            title: "lab la-ember",
            searchTerms: []
        }, {
            title: "lab la-empire",
            searchTerms: []
        }, {
            title: "las la-envelope",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support" ]
        }, {
            title: "lar la-envelope",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support" ]
        }, {
            title: "las la-envelope-open",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support" ]
        }, {
            title: "lar la-envelope-open",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support" ]
        }, {
            title: "las la-envelope-open-text",
            searchTerms: []
        }, {
            title: "las la-envelope-square",
            searchTerms: [ "e-mail", "email", "letter", "mail", "message", "notification", "support" ]
        }, {
            title: "lab la-envira",
            searchTerms: [ "leaf" ]
        }, {
            title: "las la-equals",
            searchTerms: []
        }, {
            title: "las la-eraser",
            searchTerms: [ "delete", "remove" ]
        }, {
            title: "lab la-erlang",
            searchTerms: []
        }, {
            title: "lab la-ethereum",
            searchTerms: []
        }, {
            title: "lab la-etsy",
            searchTerms: []
        }, {
            title: "las la-euro-sign",
            searchTerms: [ "eur" ]
        }, {
            title: "las la-exchange-alt",
            searchTerms: [ "arrow", "arrows", "exchange", "reciprocate", "return", "swap", "transfer" ]
        }, {
            title: "las la-exclamation",
            searchTerms: [ "alert", "danger", "error", "important", "notice", "notification", "notify", "problem", "warning" ]
        }, {
            title: "las la-exclamation-circle",
            searchTerms: [ "alert", "danger", "error", "important", "notice", "notification", "notify", "problem", "warning" ]
        }, {
            title: "las la-exclamation-triangle",
            searchTerms: [ "alert", "danger", "error", "important", "notice", "notification", "notify", "problem", "warning" ]
        }, {
            title: "las la-expand",
            searchTerms: [ "bigger", "enlarge", "resize" ]
        }, {
            title: "las la-expand-arrows-alt",
            searchTerms: [ "arrows-alt", "bigger", "enlarge", "move", "resize" ]
        }, {
            title: "lab la-expeditedssl",
            searchTerms: []
        }, {
            title: "las la-external-link-alt",
            searchTerms: [ "external-link", "new", "open" ]
        }, {
            title: "las la-external-link-square-alt",
            searchTerms: [ "external-link-square", "new", "open" ]
        }, {
            title: "las la-eye",
            searchTerms: [ "optic", "see", "seen", "show", "sight", "views", "visible" ]
        }, {
            title: "lar la-eye",
            searchTerms: [ "optic", "see", "seen", "show", "sight", "views", "visible" ]
        }, {
            title: "las la-eye-dropper",
            searchTerms: [ "eyedropper" ]
        }, {
            title: "las la-eye-slash",
            searchTerms: [ "blind", "hide", "show", "toggle", "unseen", "views", "visible", "visiblity" ]
        }, {
            title: "lar la-eye-slash",
            searchTerms: [ "blind", "hide", "show", "toggle", "unseen", "views", "visible", "visiblity" ]
        }, {
            title: "lab la-facebook",
            searchTerms: [ "facebook-official", "social network" ]
        }, {
            title: "lab la-facebook-f",
            searchTerms: [ "facebook" ]
        }, {
            title: "lab la-facebook-messenger",
            searchTerms: []
        }, {
            title: "lab la-facebook-square",
            searchTerms: [ "social network" ]
        }, {
            title: "lab la-fantasy-flight-games",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "game", "gaming", "tabletop" ]
        }, {
            title: "las la-last-backward",
            searchTerms: [ "beginning", "first", "previous", "rewind", "start" ]
        }, {
            title: "las la-last-forward",
            searchTerms: [ "end", "last", "next" ]
        }, {
            title: "las la-fax",
            searchTerms: []
        }, {
            title: "las la-feather",
            searchTerms: [ "bird", "light", "plucked", "quill" ]
        }, {
            title: "las la-feather-alt",
            searchTerms: [ "bird", "light", "plucked", "quill" ]
        }, {
            title: "las la-female",
            searchTerms: [ "human", "person", "profile", "user", "woman" ]
        }, {
            title: "las la-fighter-jet",
            searchTerms: [ "airplane", "last", "fly", "goose", "maverick", "plane", "quick", "top gun", "transportation", "travel" ]
        }, {
            title: "las la-file",
            searchTerms: [ "document", "new", "page", "pdf", "resume" ]
        }, {
            title: "lar la-file",
            searchTerms: [ "document", "new", "page", "pdf", "resume" ]
        }, {
            title: "las la-file-alt",
            searchTerms: [ "document", "file-text", "invoice", "new", "page", "pdf" ]
        }, {
            title: "lar la-file-alt",
            searchTerms: [ "document", "file-text", "invoice", "new", "page", "pdf" ]
        }, {
            title: "las la-file-archive",
            searchTerms: [ ".zip", "bundle", "compress", "compression", "download", "zip" ]
        }, {
            title: "lar la-file-archive",
            searchTerms: [ ".zip", "bundle", "compress", "compression", "download", "zip" ]
        }, {
            title: "las la-file-audio",
            searchTerms: []
        }, {
            title: "lar la-file-audio",
            searchTerms: []
        }, {
            title: "las la-file-code",
            searchTerms: []
        }, {
            title: "lar la-file-code",
            searchTerms: []
        }, {
            title: "las la-file-contract",
            searchTerms: [ "agreement", "binding", "document", "legal", "signature" ]
        }, {
            title: "las la-file-csv",
            searchTerms: [ "spreadsheets" ]
        }, {
            title: "las la-file-download",
            searchTerms: []
        }, {
            title: "las la-file-excel",
            searchTerms: []
        }, {
            title: "lar la-file-excel",
            searchTerms: []
        }, {
            title: "las la-file-export",
            searchTerms: []
        }, {
            title: "las la-file-image",
            searchTerms: []
        }, {
            title: "lar la-file-image",
            searchTerms: []
        }, {
            title: "las la-file-import",
            searchTerms: []
        }, {
            title: "las la-file-invoice",
            searchTerms: [ "bill", "document", "receipt" ]
        }, {
            title: "las la-file-invoice-dollar",
            searchTerms: [ "$", "bill", "document", "dollar-sign", "money", "receipt", "usd" ]
        }, {
            title: "las la-file-medical",
            searchTerms: []
        }, {
            title: "las la-file-medical-alt",
            searchTerms: []
        }, {
            title: "las la-file-pdf",
            searchTerms: []
        }, {
            title: "lar la-file-pdf",
            searchTerms: []
        }, {
            title: "las la-file-powerpoint",
            searchTerms: []
        }, {
            title: "lar la-file-powerpoint",
            searchTerms: []
        }, {
            title: "las la-file-prescription",
            searchTerms: [ "drugs", "medical", "medicine", "rx" ]
        }, {
            title: "las la-file-signature",
            searchTerms: [ "John Hancock", "contract", "document", "name" ]
        }, {
            title: "las la-file-upload",
            searchTerms: []
        }, {
            title: "las la-file-video",
            searchTerms: []
        }, {
            title: "lar la-file-video",
            searchTerms: []
        }, {
            title: "las la-file-word",
            searchTerms: []
        }, {
            title: "lar la-file-word",
            searchTerms: []
        }, {
            title: "las la-fill",
            searchTerms: [ "bucket", "color", "paint", "paint bucket" ]
        }, {
            title: "las la-fill-drip",
            searchTerms: [ "bucket", "color", "drop", "paint", "paint bucket", "spill" ]
        }, {
            title: "las la-film",
            searchTerms: [ "movie" ]
        }, {
            title: "las la-filter",
            searchTerms: [ "funnel", "options" ]
        }, {
            title: "las la-fingerprint",
            searchTerms: [ "human", "id", "identification", "lock", "smudge", "touch", "unique", "unlock" ]
        }, {
            title: "las la-fire",
            searchTerms: [ "caliente", "flame", "heat", "hot", "popular" ]
        }, {
            title: "las la-fire-extinguisher",
            searchTerms: []
        }, {
            title: "lab la-firefox",
            searchTerms: [ "browser" ]
        }, {
            title: "las la-first-aid",
            searchTerms: []
        }, {
            title: "lab la-first-order",
            searchTerms: []
        }, {
            title: "lab la-first-order-alt",
            searchTerms: []
        }, {
            title: "lab la-firstdraft",
            searchTerms: []
        }, {
            title: "las la-fish",
            searchTerms: [ "fauna", "gold", "swimming" ]
        }, {
            title: "las la-fist-raised",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "hand", "ki", "monk", "resist", "strength", "unarmed combat" ]
        }, {
            title: "las la-flag",
            searchTerms: [ "country", "notice", "notification", "notify", "pole", "report", "symbol" ]
        }, {
            title: "lar la-flag",
            searchTerms: [ "country", "notice", "notification", "notify", "pole", "report", "symbol" ]
        }, {
            title: "las la-flag-checkered",
            searchTerms: [ "notice", "notification", "notify", "pole", "racing", "report", "symbol" ]
        }, {
            title: "las la-flag-usa",
            searchTerms: [ "betsy ross", "country", "old glory", "stars", "stripes", "symbol" ]
        }, {
            title: "las la-flask",
            searchTerms: [ "beaker", "experimental", "labs", "science" ]
        }, {
            title: "lab la-flickr",
            searchTerms: []
        }, {
            title: "lab la-flipboard",
            searchTerms: []
        }, {
            title: "las la-flushed",
            searchTerms: [ "embarrassed", "emoticon", "face" ]
        }, {
            title: "lar la-flushed",
            searchTerms: [ "embarrassed", "emoticon", "face" ]
        }, {
            title: "lab la-fly",
            searchTerms: []
        }, {
            title: "las la-folder",
            searchTerms: []
        }, {
            title: "lar la-folder",
            searchTerms: []
        }, {
            title: "las la-folder-minus",
            searchTerms: [ "archive", "delete", "negative", "remove" ]
        }, {
            title: "las la-folder-open",
            searchTerms: []
        }, {
            title: "lar la-folder-open",
            searchTerms: []
        }, {
            title: "las la-folder-plus",
            searchTerms: [ "add", "create", "new", "positive" ]
        }, {
            title: "las la-font",
            searchTerms: [ "text" ]
        }, {
            title: "lab la-font-awesome",
            searchTerms: [ "meanpath" ]
        }, {
            title: "lab la-font-awesome-alt",
            searchTerms: []
        }, {
            title: "lab la-font-awesome-flag",
            searchTerms: []
        }, {
            title: "lar la-font-awesome-logo-full",
            searchTerms: []
        }, {
            title: "las la-font-awesome-logo-full",
            searchTerms: []
        }, {
            title: "lab la-font-awesome-logo-full",
            searchTerms: []
        }, {
            title: "lab la-fonticons",
            searchTerms: []
        }, {
            title: "lab la-fonticons-fi",
            searchTerms: []
        }, {
            title: "las la-football-ball",
            searchTerms: [ "fall", "pigskin", "seasonal" ]
        }, {
            title: "lab la-fort-awesome",
            searchTerms: [ "castle" ]
        }, {
            title: "lab la-fort-awesome-alt",
            searchTerms: [ "castle" ]
        }, {
            title: "lab la-forumbee",
            searchTerms: []
        }, {
            title: "las la-forward",
            searchTerms: [ "forward", "next" ]
        }, {
            title: "lab la-foursquare",
            searchTerms: []
        }, {
            title: "lab la-free-code-camp",
            searchTerms: []
        }, {
            title: "lab la-freebsd",
            searchTerms: []
        }, {
            title: "las la-frog",
            searchTerms: [ "amphibian", "bullfrog", "fauna", "hop", "kermit", "kiss", "prince", "ribbit", "toad", "wart" ]
        }, {
            title: "las la-frown",
            searchTerms: [ "disapprove", "emoticon", "face", "rating", "sad" ]
        }, {
            title: "lar la-frown",
            searchTerms: [ "disapprove", "emoticon", "face", "rating", "sad" ]
        }, {
            title: "las la-frown-open",
            searchTerms: [ "disapprove", "emoticon", "face", "rating", "sad" ]
        }, {
            title: "lar la-frown-open",
            searchTerms: [ "disapprove", "emoticon", "face", "rating", "sad" ]
        }, {
            title: "lab la-fulcrum",
            searchTerms: []
        }, {
            title: "las la-funnel-dollar",
            searchTerms: []
        }, {
            title: "las la-futbol",
            searchTerms: [ "ball", "football", "soccer" ]
        }, {
            title: "lar la-futbol",
            searchTerms: [ "ball", "football", "soccer" ]
        }, {
            title: "lab la-galactic-republic",
            searchTerms: [ "politics", "star wars" ]
        }, {
            title: "lab la-galactic-senate",
            searchTerms: [ "star wars" ]
        }, {
            title: "las la-gamepad",
            searchTerms: [ "controller" ]
        }, {
            title: "las la-gas-pump",
            searchTerms: []
        }, {
            title: "las la-gavel",
            searchTerms: [ "hammer", "judge", "lawyer", "opinion" ]
        }, {
            title: "las la-gem",
            searchTerms: [ "diamond" ]
        }, {
            title: "lar la-gem",
            searchTerms: [ "diamond" ]
        }, {
            title: "las la-genderless",
            searchTerms: []
        }, {
            title: "lab la-get-pocket",
            searchTerms: []
        }, {
            title: "lab la-gg",
            searchTerms: []
        }, {
            title: "lab la-gg-circle",
            searchTerms: []
        }, {
            title: "las la-ghost",
            searchTerms: [ "apparition", "blinky", "clyde", "floating", "halloween", "holiday", "inky", "pinky", "spirit" ]
        }, {
            title: "las la-gift",
            searchTerms: [ "generosity", "giving", "party", "present", "wrapped" ]
        }, {
            title: "lab la-git",
            searchTerms: []
        }, {
            title: "lab la-git-square",
            searchTerms: []
        }, {
            title: "lab la-github",
            searchTerms: [ "octocat" ]
        }, {
            title: "lab la-github-alt",
            searchTerms: [ "octocat" ]
        }, {
            title: "lab la-github-square",
            searchTerms: [ "octocat" ]
        }, {
            title: "lab la-gitkraken",
            searchTerms: []
        }, {
            title: "lab la-gitlab",
            searchTerms: [ "Axosoft" ]
        }, {
            title: "lab la-gitter",
            searchTerms: []
        }, {
            title: "las la-glass-martini",
            searchTerms: [ "alcohol", "bar", "beverage", "drink", "glass", "liquor", "martini" ]
        }, {
            title: "las la-glass-martini-alt",
            searchTerms: []
        }, {
            title: "las la-glasses",
            searchTerms: [ "foureyes", "hipster", "nerd", "reading", "sight", "spectacles" ]
        }, {
            title: "lab la-glide",
            searchTerms: []
        }, {
            title: "lab la-glide-g",
            searchTerms: []
        }, {
            title: "las la-globe",
            searchTerms: [ "all", "coordinates", "country", "earth", "global", "gps", "language", "localize", "location", "map", "online", "place", "planet", "translate", "travel", "world" ]
        }, {
            title: "las la-globe-africa",
            searchTerms: [ "all", "country", "earth", "global", "gps", "language", "localize", "location", "map", "online", "place", "planet", "translate", "travel", "world" ]
        }, {
            title: "las la-globe-americas",
            searchTerms: [ "all", "country", "earth", "global", "gps", "language", "localize", "location", "map", "online", "place", "planet", "translate", "travel", "world" ]
        }, {
            title: "las la-globe-asia",
            searchTerms: [ "all", "country", "earth", "global", "gps", "language", "localize", "location", "map", "online", "place", "planet", "translate", "travel", "world" ]
        }, {
            title: "lab la-gofore",
            searchTerms: []
        }, {
            title: "las la-golf-ball",
            searchTerms: []
        }, {
            title: "lab la-goodreads",
            searchTerms: []
        }, {
            title: "lab la-goodreads-g",
            searchTerms: []
        }, {
            title: "lab la-google",
            searchTerms: []
        }, {
            title: "lab la-google-drive",
            searchTerms: []
        }, {
            title: "lab la-google-play",
            searchTerms: []
        }, {
            title: "lab la-google-plus",
            searchTerms: [ "google-plus-circle", "google-plus-official" ]
        }, {
            title: "lab la-google-plus-g",
            searchTerms: [ "google-plus", "social network" ]
        }, {
            title: "lab la-google-plus-square",
            searchTerms: [ "social network" ]
        }, {
            title: "lab la-google-wallet",
            searchTerms: []
        }, {
            title: "las la-gopuram",
            searchTerms: [ "building", "entrance", "hinduism", "temple", "tower" ]
        }, {
            title: "las la-graduation-cap",
            searchTerms: [ "learning", "school", "student" ]
        }, {
            title: "lab la-gratipay",
            searchTerms: [ "favorite", "heart", "like", "love" ]
        }, {
            title: "lab la-grav",
            searchTerms: []
        }, {
            title: "las la-greater-than",
            searchTerms: []
        }, {
            title: "las la-greater-than-equal",
            searchTerms: []
        }, {
            title: "las la-grimace",
            searchTerms: [ "cringe", "emoticon", "face" ]
        }, {
            title: "lar la-grimace",
            searchTerms: [ "cringe", "emoticon", "face" ]
        }, {
            title: "las la-grin",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "lar la-grin",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "las la-grin-alt",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "lar la-grin-alt",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "las la-grin-beam",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "lar la-grin-beam",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "las la-grin-beam-sweat",
            searchTerms: [ "emoticon", "face", "smile" ]
        }, {
            title: "lar la-grin-beam-sweat",
            searchTerms: [ "emoticon", "face", "smile" ]
        }, {
            title: "las la-grin-hearts",
            searchTerms: [ "emoticon", "face", "love", "smile" ]
        }, {
            title: "lar la-grin-hearts",
            searchTerms: [ "emoticon", "face", "love", "smile" ]
        }, {
            title: "las la-grin-squint",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "lar la-grin-squint",
            searchTerms: [ "emoticon", "face", "laugh", "smile" ]
        }, {
            title: "las la-grin-squint-tears",
            searchTerms: [ "emoticon", "face", "happy", "smile" ]
        }, {
            title: "lar la-grin-squint-tears",
            searchTerms: [ "emoticon", "face", "happy", "smile" ]
        }, {
            title: "las la-grin-stars",
            searchTerms: [ "emoticon", "face", "star-struck" ]
        }, {
            title: "lar la-grin-stars",
            searchTerms: [ "emoticon", "face", "star-struck" ]
        }, {
            title: "las la-grin-tears",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "lar la-grin-tears",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "las la-grin-tongue",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "lar la-grin-tongue",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "las la-grin-tongue-squint",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "lar la-grin-tongue-squint",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "las la-grin-tongue-wink",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "lar la-grin-tongue-wink",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "las la-grin-wink",
            searchTerms: [ "emoticon", "face", "flirt", "laugh", "smile" ]
        }, {
            title: "lar la-grin-wink",
            searchTerms: [ "emoticon", "face", "flirt", "laugh", "smile" ]
        }, {
            title: "las la-grip-horizontal",
            searchTerms: [ "affordance", "drag", "drop", "grab", "handle" ]
        }, {
            title: "las la-grip-vertical",
            searchTerms: [ "affordance", "drag", "drop", "grab", "handle" ]
        }, {
            title: "lab la-gripfire",
            searchTerms: []
        }, {
            title: "lab la-grunt",
            searchTerms: []
        }, {
            title: "lab la-gulp",
            searchTerms: []
        }, {
            title: "las la-h-square",
            searchTerms: [ "hospital", "hotel" ]
        }, {
            title: "lab la-hacker-news",
            searchTerms: []
        }, {
            title: "lab la-hacker-news-square",
            searchTerms: []
        }, {
            title: "lab la-hackerrank",
            searchTerms: []
        }, {
            title: "las la-hammer",
            searchTerms: [ "admin", "fix", "repair", "settings", "tool" ]
        }, {
            title: "las la-hamsa",
            searchTerms: [ "amulet", "christianity", "islam", "jewish", "judaism", "muslim", "protection" ]
        }, {
            title: "las la-hand-holding",
            searchTerms: []
        }, {
            title: "las la-hand-holding-heart",
            searchTerms: []
        }, {
            title: "las la-hand-holding-usd",
            searchTerms: [ "$", "dollar sign", "donation", "giving", "money", "price" ]
        }, {
            title: "las la-hand-lizard",
            searchTerms: []
        }, {
            title: "lar la-hand-lizard",
            searchTerms: []
        }, {
            title: "las la-hand-paper",
            searchTerms: [ "stop" ]
        }, {
            title: "lar la-hand-paper",
            searchTerms: [ "stop" ]
        }, {
            title: "las la-hand-peace",
            searchTerms: []
        }, {
            title: "lar la-hand-peace",
            searchTerms: []
        }, {
            title: "las la-hand-point-down",
            searchTerms: [ "finger", "hand-o-down", "point" ]
        }, {
            title: "lar la-hand-point-down",
            searchTerms: [ "finger", "hand-o-down", "point" ]
        }, {
            title: "las la-hand-point-left",
            searchTerms: [ "back", "finger", "hand-o-left", "left", "point", "previous" ]
        }, {
            title: "lar la-hand-point-left",
            searchTerms: [ "back", "finger", "hand-o-left", "left", "point", "previous" ]
        }, {
            title: "las la-hand-point-right",
            searchTerms: [ "finger", "forward", "hand-o-right", "next", "point", "right" ]
        }, {
            title: "lar la-hand-point-right",
            searchTerms: [ "finger", "forward", "hand-o-right", "next", "point", "right" ]
        }, {
            title: "las la-hand-point-up",
            searchTerms: [ "finger", "hand-o-up", "point" ]
        }, {
            title: "lar la-hand-point-up",
            searchTerms: [ "finger", "hand-o-up", "point" ]
        }, {
            title: "las la-hand-pointer",
            searchTerms: [ "select" ]
        }, {
            title: "lar la-hand-pointer",
            searchTerms: [ "select" ]
        }, {
            title: "las la-hand-rock",
            searchTerms: []
        }, {
            title: "lar la-hand-rock",
            searchTerms: []
        }, {
            title: "las la-hand-scissors",
            searchTerms: []
        }, {
            title: "lar la-hand-scissors",
            searchTerms: []
        }, {
            title: "las la-hand-spock",
            searchTerms: []
        }, {
            title: "lar la-hand-spock",
            searchTerms: []
        }, {
            title: "las la-hands",
            searchTerms: []
        }, {
            title: "las la-hands-helping",
            searchTerms: [ "aid", "assistance", "partnership", "volunteering" ]
        }, {
            title: "las la-handshake",
            searchTerms: [ "greeting", "partnership" ]
        }, {
            title: "lar la-handshake",
            searchTerms: [ "greeting", "partnership" ]
        }, {
            title: "las la-hanukiah",
            searchTerms: [ "candle", "hanukkah", "jewish", "judaism", "light" ]
        }, {
            title: "las la-hashtag",
            searchTerms: []
        }, {
            title: "las la-hat-wizard",
            searchTerms: [ "Dungeons & Dragons", "buckle", "cloth", "clothing", "d&d", "dnd", "fantasy", "halloween", "holiday", "mage", "magic", "pointy", "witch" ]
        }, {
            title: "las la-haykal",
            searchTerms: [ "bahai", "bahá'í", "star" ]
        }, {
            title: "las la-hdd",
            searchTerms: [ "cpu", "hard drive", "harddrive", "machine", "save", "storage" ]
        }, {
            title: "lar la-hdd",
            searchTerms: [ "cpu", "hard drive", "harddrive", "machine", "save", "storage" ]
        }, {
            title: "las la-heading",
            searchTerms: [ "header" ]
        }, {
            title: "las la-headphones",
            searchTerms: [ "audio", "listen", "music", "sound", "speaker" ]
        }, {
            title: "las la-headphones-alt",
            searchTerms: [ "audio", "listen", "music", "sound", "speaker" ]
        }, {
            title: "las la-headset",
            searchTerms: [ "audio", "gamer", "gaming", "listen", "live chat", "microphone", "shot caller", "sound", "support", "telemarketer" ]
        }, {
            title: "las la-heart",
            searchTerms: [ "favorite", "like", "love" ]
        }, {
            title: "lar la-heart",
            searchTerms: [ "favorite", "like", "love" ]
        }, {
            title: "las la-heartbeat",
            searchTerms: [ "ekg", "lifeline", "vital signs" ]
        }, {
            title: "las la-helicopter",
            searchTerms: [ "airwolf", "apache", "chopper", "flight", "fly" ]
        }, {
            title: "las la-highlighter",
            searchTerms: [ "edit", "marker", "sharpie", "update", "write" ]
        }, {
            title: "las la-hiking",
            searchTerms: [ "activity", "backpack", "fall", "fitness", "outdoors", "seasonal", "walking" ]
        }, {
            title: "las la-hippo",
            searchTerms: [ "fauna", "hungry", "mammmal" ]
        }, {
            title: "lab la-hips",
            searchTerms: []
        }, {
            title: "lab la-hire-a-helper",
            searchTerms: []
        }, {
            title: "las la-history",
            searchTerms: []
        }, {
            title: "las la-hockey-puck",
            searchTerms: []
        }, {
            title: "las la-home",
            searchTerms: [ "house", "main" ]
        }, {
            title: "lab la-hooli",
            searchTerms: []
        }, {
            title: "lab la-hornbill",
            searchTerms: []
        }, {
            title: "las la-horse",
            searchTerms: [ "equus", "fauna", "mammmal", "neigh" ]
        }, {
            title: "las la-hospital",
            searchTerms: [ "building", "emergency room", "medical center" ]
        }, {
            title: "lar la-hospital",
            searchTerms: [ "building", "emergency room", "medical center" ]
        }, {
            title: "las la-hospital-alt",
            searchTerms: [ "building", "emergency room", "medical center" ]
        }, {
            title: "las la-hospital-symbol",
            searchTerms: []
        }, {
            title: "las la-hot-tub",
            searchTerms: []
        }, {
            title: "las la-hotel",
            searchTerms: [ "building", "lodging" ]
        }, {
            title: "lab la-hotjar",
            searchTerms: []
        }, {
            title: "las la-hourglass",
            searchTerms: []
        }, {
            title: "lar la-hourglass",
            searchTerms: []
        }, {
            title: "las la-hourglass-end",
            searchTerms: []
        }, {
            title: "las la-hourglass-half",
            searchTerms: []
        }, {
            title: "las la-hourglass-start",
            searchTerms: []
        }, {
            title: "las la-house-damage",
            searchTerms: [ "devastation", "home" ]
        }, {
            title: "lab la-houzz",
            searchTerms: []
        }, {
            title: "las la-hryvnia",
            searchTerms: [ "money" ]
        }, {
            title: "lab la-html5",
            searchTerms: []
        }, {
            title: "lab la-hubspot",
            searchTerms: []
        }, {
            title: "las la-i-cursor",
            searchTerms: []
        }, {
            title: "las la-id-badge",
            searchTerms: []
        }, {
            title: "lar la-id-badge",
            searchTerms: []
        }, {
            title: "las la-id-card",
            searchTerms: [ "document", "identification", "issued" ]
        }, {
            title: "lar la-id-card",
            searchTerms: [ "document", "identification", "issued" ]
        }, {
            title: "las la-id-card-alt",
            searchTerms: [ "demographics" ]
        }, {
            title: "las la-image",
            searchTerms: [ "album", "photo", "picture" ]
        }, {
            title: "lar la-image",
            searchTerms: [ "album", "photo", "picture" ]
        }, {
            title: "las la-images",
            searchTerms: [ "album", "photo", "picture" ]
        }, {
            title: "lar la-images",
            searchTerms: [ "album", "photo", "picture" ]
        }, {
            title: "lab la-imdb",
            searchTerms: []
        }, {
            title: "las la-inbox",
            searchTerms: []
        }, {
            title: "las la-indent",
            searchTerms: []
        }, {
            title: "las la-industry",
            searchTerms: [ "factory", "manufacturing" ]
        }, {
            title: "las la-infinity",
            searchTerms: []
        }, {
            title: "las la-info",
            searchTerms: [ "details", "help", "information", "more" ]
        }, {
            title: "las la-info-circle",
            searchTerms: [ "details", "help", "information", "more" ]
        }, {
            title: "lab la-instagram",
            searchTerms: []
        }, {
            title: "lab la-internet-explorer",
            searchTerms: [ "browser", "ie" ]
        }, {
            title: "lab la-ioxhost",
            searchTerms: []
        }, {
            title: "las la-italic",
            searchTerms: [ "italics" ]
        }, {
            title: "lab la-itunes",
            searchTerms: []
        }, {
            title: "lab la-itunes-note",
            searchTerms: []
        }, {
            title: "lab la-java",
            searchTerms: []
        }, {
            title: "las la-jedi",
            searchTerms: [ "star wars" ]
        }, {
            title: "lab la-jedi-order",
            searchTerms: [ "star wars" ]
        }, {
            title: "lab la-jenkins",
            searchTerms: []
        }, {
            title: "lab la-joget",
            searchTerms: []
        }, {
            title: "las la-joint",
            searchTerms: [ "blunt", "cannabis", "doobie", "drugs", "marijuana", "roach", "smoke", "smoking", "spliff" ]
        }, {
            title: "lab la-joomla",
            searchTerms: []
        }, {
            title: "las la-journal-whills",
            searchTerms: [ "book", "jedi", "star wars", "the force" ]
        }, {
            title: "lab la-js",
            searchTerms: []
        }, {
            title: "lab la-js-square",
            searchTerms: []
        }, {
            title: "lab la-jsfiddle",
            searchTerms: []
        }, {
            title: "las la-kaaba",
            searchTerms: [ "building", "cube", "islam", "muslim" ]
        }, {
            title: "lab la-kaggle",
            searchTerms: []
        }, {
            title: "las la-key",
            searchTerms: [ "password", "unlock" ]
        }, {
            title: "lab la-keybase",
            searchTerms: []
        }, {
            title: "las la-keyboard",
            searchTerms: [ "input", "type" ]
        }, {
            title: "lar la-keyboard",
            searchTerms: [ "input", "type" ]
        }, {
            title: "lab la-keycdn",
            searchTerms: []
        }, {
            title: "las la-khanda",
            searchTerms: [ "chakkar", "sikh", "sikhism", "sword" ]
        }, {
            title: "lab la-kickstarter",
            searchTerms: []
        }, {
            title: "lab la-kickstarter-k",
            searchTerms: []
        }, {
            title: "las la-kiss",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "lar la-kiss",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "las la-kiss-beam",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "lar la-kiss-beam",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "las la-kiss-wink-heart",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "lar la-kiss-wink-heart",
            searchTerms: [ "beso", "emoticon", "face", "love", "smooch" ]
        }, {
            title: "las la-kiwi-bird",
            searchTerms: [ "bird", "fauna" ]
        }, {
            title: "lab la-korvue",
            searchTerms: []
        }, {
            title: "las la-landmark",
            searchTerms: [ "building", "historic", "memoroable", "politics" ]
        }, {
            title: "las la-language",
            searchTerms: [ "dialect", "idiom", "localize", "speech", "translate", "vernacular" ]
        }, {
            title: "las la-laptop",
            searchTerms: [ "computer", "cpu", "dell", "demo", "device", "dude you're getting", "mac", "macbook", "machine", "pc" ]
        }, {
            title: "las la-laptop-code",
            searchTerms: []
        }, {
            title: "lab la-laravel",
            searchTerms: []
        }, {
            title: "lab la-lastfm",
            searchTerms: []
        }, {
            title: "lab la-lastfm-square",
            searchTerms: []
        }, {
            title: "las la-laugh",
            searchTerms: [ "LOL", "emoticon", "face", "laugh" ]
        }, {
            title: "lar la-laugh",
            searchTerms: [ "LOL", "emoticon", "face", "laugh" ]
        }, {
            title: "las la-laugh-beam",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "lar la-laugh-beam",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "las la-laugh-squint",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "lar la-laugh-squint",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "las la-laugh-wink",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "lar la-laugh-wink",
            searchTerms: [ "LOL", "emoticon", "face" ]
        }, {
            title: "las la-layer-group",
            searchTerms: [ "layers" ]
        }, {
            title: "las la-leaf",
            searchTerms: [ "eco", "flora", "nature", "plant" ]
        }, {
            title: "lab la-leanpub",
            searchTerms: []
        }, {
            title: "las la-lemon",
            searchTerms: [ "food" ]
        }, {
            title: "lar la-lemon",
            searchTerms: [ "food" ]
        }, {
            title: "lab la-less",
            searchTerms: []
        }, {
            title: "las la-less-than",
            searchTerms: []
        }, {
            title: "las la-less-than-equal",
            searchTerms: []
        }, {
            title: "las la-level-down-alt",
            searchTerms: [ "level-down" ]
        }, {
            title: "las la-level-up-alt",
            searchTerms: [ "level-up" ]
        }, {
            title: "las la-life-ring",
            searchTerms: [ "support" ]
        }, {
            title: "lar la-life-ring",
            searchTerms: [ "support" ]
        }, {
            title: "las la-lightbulb",
            searchTerms: [ "idea", "inspiration" ]
        }, {
            title: "lar la-lightbulb",
            searchTerms: [ "idea", "inspiration" ]
        }, {
            title: "lab la-line",
            searchTerms: []
        }, {
            title: "las la-link",
            searchTerms: [ "chain" ]
        }, {
            title: "lab la-linkedin",
            searchTerms: [ "linkedin-square" ]
        }, {
            title: "lab la-linkedin-in",
            searchTerms: [ "linkedin" ]
        }, {
            title: "lab la-linode",
            searchTerms: []
        }, {
            title: "lab la-linux",
            searchTerms: [ "tux" ]
        }, {
            title: "las la-lira-sign",
            searchTerms: [ "try", "turkish" ]
        }, {
            title: "las la-list",
            searchTerms: [ "checklist", "completed", "done", "finished", "ol", "todo", "ul" ]
        }, {
            title: "las la-list-alt",
            searchTerms: [ "checklist", "completed", "done", "finished", "ol", "todo", "ul" ]
        }, {
            title: "lar la-list-alt",
            searchTerms: [ "checklist", "completed", "done", "finished", "ol", "todo", "ul" ]
        }, {
            title: "las la-list-ol",
            searchTerms: [ "checklist", "list", "numbers", "ol", "todo", "ul" ]
        }, {
            title: "las la-list-ul",
            searchTerms: [ "checklist", "list", "ol", "todo", "ul" ]
        }, {
            title: "las la-location-arrow",
            searchTerms: [ "address", "coordinates", "gps", "location", "map", "place", "where" ]
        }, {
            title: "las la-lock",
            searchTerms: [ "admin", "protect", "security" ]
        }, {
            title: "las la-lock-open",
            searchTerms: [ "admin", "lock", "open", "password", "protect" ]
        }, {
            title: "las la-long-arrow-alt-down",
            searchTerms: [ "long-arrow-down" ]
        }, {
            title: "las la-long-arrow-alt-left",
            searchTerms: [ "back", "long-arrow-left", "previous" ]
        }, {
            title: "las la-long-arrow-alt-right",
            searchTerms: [ "long-arrow-right" ]
        }, {
            title: "las la-long-arrow-alt-up",
            searchTerms: [ "long-arrow-up" ]
        }, {
            title: "las la-low-vision",
            searchTerms: []
        }, {
            title: "las la-luggage-cart",
            searchTerms: []
        }, {
            title: "lab la-lyft",
            searchTerms: []
        }, {
            title: "lab la-magento",
            searchTerms: []
        }, {
            title: "las la-magic",
            searchTerms: [ "autocomplete", "automatic", "mage", "magic", "spell", "witch", "wizard" ]
        }, {
            title: "las la-magnet",
            searchTerms: []
        }, {
            title: "las la-mail-bulk",
            searchTerms: []
        }, {
            title: "lab la-mailchimp",
            searchTerms: []
        }, {
            title: "las la-male",
            searchTerms: [ "human", "man", "person", "profile", "user" ]
        }, {
            title: "lab la-mandalorian",
            searchTerms: []
        }, {
            title: "las la-map",
            searchTerms: [ "coordinates", "location", "paper", "place", "travel" ]
        }, {
            title: "lar la-map",
            searchTerms: [ "coordinates", "location", "paper", "place", "travel" ]
        }, {
            title: "las la-map-marked",
            searchTerms: [ "address", "coordinates", "destination", "gps", "localize", "location", "map", "paper", "pin", "place", "point of interest", "position", "route", "travel", "where" ]
        }, {
            title: "las la-map-marked-alt",
            searchTerms: [ "address", "coordinates", "destination", "gps", "localize", "location", "map", "paper", "pin", "place", "point of interest", "position", "route", "travel", "where" ]
        }, {
            title: "las la-map-marker",
            searchTerms: [ "address", "coordinates", "gps", "localize", "location", "map", "pin", "place", "position", "travel", "where" ]
        }, {
            title: "las la-map-marker-alt",
            searchTerms: [ "address", "coordinates", "gps", "localize", "location", "map", "pin", "place", "position", "travel", "where" ]
        }, {
            title: "las la-map-pin",
            searchTerms: [ "address", "coordinates", "gps", "localize", "location", "map", "marker", "place", "position", "travel", "where" ]
        }, {
            title: "las la-map-signs",
            searchTerms: []
        }, {
            title: "lab la-markdown",
            searchTerms: []
        }, {
            title: "las la-marker",
            searchTerms: [ "edit", "sharpie", "update", "write" ]
        }, {
            title: "las la-mars",
            searchTerms: [ "male" ]
        }, {
            title: "las la-mars-double",
            searchTerms: []
        }, {
            title: "las la-mars-stroke",
            searchTerms: []
        }, {
            title: "las la-mars-stroke-h",
            searchTerms: []
        }, {
            title: "las la-mars-stroke-v",
            searchTerms: []
        }, {
            title: "las la-mask",
            searchTerms: [ "costume", "disguise", "halloween", "holiday", "secret", "super hero" ]
        }, {
            title: "lab la-mastodon",
            searchTerms: []
        }, {
            title: "lab la-maxcdn",
            searchTerms: []
        }, {
            title: "las la-medal",
            searchTerms: []
        }, {
            title: "lab la-medapps",
            searchTerms: []
        }, {
            title: "lab la-medium",
            searchTerms: []
        }, {
            title: "lab la-medium-m",
            searchTerms: []
        }, {
            title: "las la-medkit",
            searchTerms: [ "first aid", "firstaid", "health", "help", "support" ]
        }, {
            title: "lab la-medrt",
            searchTerms: []
        }, {
            title: "lab la-meetup",
            searchTerms: []
        }, {
            title: "lab la-megaport",
            searchTerms: []
        }, {
            title: "las la-meh",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "lar la-meh",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "las la-meh-blank",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "lar la-meh-blank",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "las la-meh-rolling-eyes",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "lar la-meh-rolling-eyes",
            searchTerms: [ "emoticon", "face", "neutral", "rating" ]
        }, {
            title: "las la-memory",
            searchTerms: [ "DIMM", "RAM" ]
        }, {
            title: "las la-menorah",
            searchTerms: [ "candle", "hanukkah", "jewish", "judaism", "light" ]
        }, {
            title: "las la-mercury",
            searchTerms: [ "transgender" ]
        }, {
            title: "las la-meteor",
            searchTerms: []
        }, {
            title: "las la-microchip",
            searchTerms: [ "cpu", "processor" ]
        }, {
            title: "las la-microphone",
            searchTerms: [ "record", "sound", "voice" ]
        }, {
            title: "las la-microphone-alt",
            searchTerms: [ "record", "sound", "voice" ]
        }, {
            title: "las la-microphone-alt-slash",
            searchTerms: [ "disable", "mute", "record", "sound", "voice" ]
        }, {
            title: "las la-microphone-slash",
            searchTerms: [ "disable", "mute", "record", "sound", "voice" ]
        }, {
            title: "las la-microscope",
            searchTerms: []
        }, {
            title: "lab la-microsoft",
            searchTerms: []
        }, {
            title: "las la-minus",
            searchTerms: [ "collapse", "delete", "hide", "minify", "negative", "remove", "trash" ]
        }, {
            title: "las la-minus-circle",
            searchTerms: [ "delete", "hide", "negative", "remove", "trash" ]
        }, {
            title: "las la-minus-square",
            searchTerms: [ "collapse", "delete", "hide", "minify", "negative", "remove", "trash" ]
        }, {
            title: "lar la-minus-square",
            searchTerms: [ "collapse", "delete", "hide", "minify", "negative", "remove", "trash" ]
        }, {
            title: "lab la-mix",
            searchTerms: []
        }, {
            title: "lab la-mixcloud",
            searchTerms: []
        }, {
            title: "lab la-mizuni",
            searchTerms: []
        }, {
            title: "las la-mobile",
            searchTerms: [ "apple", "call", "cell phone", "cellphone", "device", "iphone", "number", "screen", "telephone", "text" ]
        }, {
            title: "las la-mobile-alt",
            searchTerms: [ "apple", "call", "cell phone", "cellphone", "device", "iphone", "number", "screen", "telephone", "text" ]
        }, {
            title: "lab la-modx",
            searchTerms: []
        }, {
            title: "lab la-monero",
            searchTerms: []
        }, {
            title: "las la-money-bill",
            searchTerms: [ "buy", "cash", "checkout", "money", "payment", "price", "purchase" ]
        }, {
            title: "las la-money-bill-alt",
            searchTerms: [ "buy", "cash", "checkout", "money", "payment", "price", "purchase" ]
        }, {
            title: "lar la-money-bill-alt",
            searchTerms: [ "buy", "cash", "checkout", "money", "payment", "price", "purchase" ]
        }, {
            title: "las la-money-bill-wave",
            searchTerms: []
        }, {
            title: "las la-money-bill-wave-alt",
            searchTerms: []
        }, {
            title: "las la-money-check",
            searchTerms: [ "bank check", "cheque" ]
        }, {
            title: "las la-money-check-alt",
            searchTerms: [ "bank check", "cheque" ]
        }, {
            title: "las la-monument",
            searchTerms: [ "building", "historic", "memoroable" ]
        }, {
            title: "las la-moon",
            searchTerms: [ "contrast", "crescent", "darker", "lunar", "night" ]
        }, {
            title: "lar la-moon",
            searchTerms: [ "contrast", "crescent", "darker", "lunar", "night" ]
        }, {
            title: "las la-mortar-pestle",
            searchTerms: [ "crush", "culinary", "grind", "medical", "mix", "spices" ]
        }, {
            title: "las la-mosque",
            searchTerms: [ "building", "islam", "muslim" ]
        }, {
            title: "las la-motorcycle",
            searchTerms: [ "bike", "machine", "transportation", "vehicle" ]
        }, {
            title: "las la-mountain",
            searchTerms: []
        }, {
            title: "las la-mouse-pointer",
            searchTerms: [ "select" ]
        }, {
            title: "las la-music",
            searchTerms: [ "note", "sound" ]
        }, {
            title: "lab la-napster",
            searchTerms: []
        }, {
            title: "lab la-neos",
            searchTerms: []
        }, {
            title: "las la-network-wired",
            searchTerms: []
        }, {
            title: "las la-neuter",
            searchTerms: []
        }, {
            title: "las la-newspaper",
            searchTerms: [ "article", "press" ]
        }, {
            title: "lar la-newspaper",
            searchTerms: [ "article", "press" ]
        }, {
            title: "lab la-nimblr",
            searchTerms: []
        }, {
            title: "lab la-nintendo-switch",
            searchTerms: []
        }, {
            title: "lab la-node",
            searchTerms: []
        }, {
            title: "lab la-node-js",
            searchTerms: []
        }, {
            title: "las la-not-equal",
            searchTerms: []
        }, {
            title: "las la-notes-medical",
            searchTerms: []
        }, {
            title: "lab la-npm",
            searchTerms: []
        }, {
            title: "lab la-ns8",
            searchTerms: []
        }, {
            title: "lab la-nutritionix",
            searchTerms: []
        }, {
            title: "las la-object-group",
            searchTerms: [ "design" ]
        }, {
            title: "lar la-object-group",
            searchTerms: [ "design" ]
        }, {
            title: "las la-object-ungroup",
            searchTerms: [ "design" ]
        }, {
            title: "lar la-object-ungroup",
            searchTerms: [ "design" ]
        }, {
            title: "lab la-odnoklassniki",
            searchTerms: []
        }, {
            title: "lab la-odnoklassniki-square",
            searchTerms: []
        }, {
            title: "las la-oil-can",
            searchTerms: []
        }, {
            title: "lab la-old-republic",
            searchTerms: [ "politics", "star wars" ]
        }, {
            title: "las la-om",
            searchTerms: [ "buddhism", "hinduism", "jainism", "mantra" ]
        }, {
            title: "lab la-opencart",
            searchTerms: []
        }, {
            title: "lab la-openid",
            searchTerms: []
        }, {
            title: "lab la-opera",
            searchTerms: []
        }, {
            title: "lab la-optin-monster",
            searchTerms: []
        }, {
            title: "lab la-osi",
            searchTerms: []
        }, {
            title: "las la-otter",
            searchTerms: [ "fauna", "mammmal" ]
        }, {
            title: "las la-outdent",
            searchTerms: []
        }, {
            title: "lab la-page4",
            searchTerms: []
        }, {
            title: "lab la-pagelines",
            searchTerms: [ "eco", "flora", "leaf", "leaves", "nature", "plant", "tree" ]
        }, {
            title: "las la-paint-brush",
            searchTerms: []
        }, {
            title: "las la-paint-roller",
            searchTerms: [ "brush", "painting", "tool" ]
        }, {
            title: "las la-palette",
            searchTerms: [ "colors", "painting" ]
        }, {
            title: "lab la-palfed",
            searchTerms: []
        }, {
            title: "las la-pallet",
            searchTerms: []
        }, {
            title: "las la-paper-plane",
            searchTerms: []
        }, {
            title: "lar la-paper-plane",
            searchTerms: []
        }, {
            title: "las la-paperclip",
            searchTerms: [ "attachment" ]
        }, {
            title: "las la-parachute-box",
            searchTerms: [ "aid", "assistance", "rescue", "supplies" ]
        }, {
            title: "las la-paragraph",
            searchTerms: []
        }, {
            title: "las la-parking",
            searchTerms: []
        }, {
            title: "las la-passport",
            searchTerms: [ "document", "identification", "issued" ]
        }, {
            title: "las la-pastalarianism",
            searchTerms: [ "agnosticism", "atheism", "flying spaghetti monster", "fsm" ]
        }, {
            title: "las la-paste",
            searchTerms: [ "clipboard", "copy" ]
        }, {
            title: "lab la-patreon",
            searchTerms: []
        }, {
            title: "las la-pause",
            searchTerms: [ "wait" ]
        }, {
            title: "las la-pause-circle",
            searchTerms: []
        }, {
            title: "lar la-pause-circle",
            searchTerms: []
        }, {
            title: "las la-paw",
            searchTerms: [ "animal", "pet" ]
        }, {
            title: "lab la-paypal",
            searchTerms: []
        }, {
            title: "las la-peace",
            searchTerms: []
        }, {
            title: "las la-pen",
            searchTerms: [ "design", "edit", "update", "write" ]
        }, {
            title: "las la-pen-alt",
            searchTerms: [ "design", "edit", "update", "write" ]
        }, {
            title: "las la-pen-fancy",
            searchTerms: [ "design", "edit", "fountain pen", "update", "write" ]
        }, {
            title: "las la-pen-nib",
            searchTerms: [ "design", "edit", "fountain pen", "update", "write" ]
        }, {
            title: "las la-pen-square",
            searchTerms: [ "edit", "pencil-square", "update", "write" ]
        }, {
            title: "las la-pencil-alt",
            searchTerms: [ "design", "edit", "pencil", "update", "write" ]
        }, {
            title: "las la-pencil-ruler",
            searchTerms: []
        }, {
            title: "lab la-penny-arcade",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "game", "gaming", "pax", "tabletop" ]
        }, {
            title: "las la-people-carry",
            searchTerms: [ "movers" ]
        }, {
            title: "las la-percent",
            searchTerms: []
        }, {
            title: "las la-percentage",
            searchTerms: []
        }, {
            title: "lab la-periscope",
            searchTerms: []
        }, {
            title: "las la-person-booth",
            searchTerms: [ "changing", "changing room", "election", "human", "person", "vote", "voting" ]
        }, {
            title: "lab la-phabricator",
            searchTerms: []
        }, {
            title: "lab la-phoenix-framework",
            searchTerms: []
        }, {
            title: "lab la-phoenix-squadron",
            searchTerms: []
        }, {
            title: "las la-phone",
            searchTerms: [ "call", "earphone", "number", "support", "telephone", "voice" ]
        }, {
            title: "las la-phone-slash",
            searchTerms: []
        }, {
            title: "las la-phone-square",
            searchTerms: [ "call", "number", "support", "telephone", "voice" ]
        }, {
            title: "las la-phone-volume",
            searchTerms: [ "telephone", "volume-control-phone" ]
        }, {
            title: "lab la-php",
            searchTerms: []
        }, {
            title: "lab la-pied-piper",
            searchTerms: []
        }, {
            title: "lab la-pied-piper-alt",
            searchTerms: []
        }, {
            title: "lab la-pied-piper-hat",
            searchTerms: [ "clothing" ]
        }, {
            title: "lab la-pied-piper-pp",
            searchTerms: []
        }, {
            title: "las la-piggy-bank",
            searchTerms: [ "save", "savings" ]
        }, {
            title: "las la-pills",
            searchTerms: [ "drugs", "medicine" ]
        }, {
            title: "lab la-pinterest",
            searchTerms: []
        }, {
            title: "lab la-pinterest-p",
            searchTerms: []
        }, {
            title: "lab la-pinterest-square",
            searchTerms: []
        }, {
            title: "las la-place-of-worship",
            searchTerms: []
        }, {
            title: "las la-plane",
            searchTerms: [ "airplane", "destination", "fly", "location", "mode", "travel", "trip" ]
        }, {
            title: "las la-plane-arrival",
            searchTerms: [ "airplane", "arriving", "destination", "fly", "land", "landing", "location", "mode", "travel", "trip" ]
        }, {
            title: "las la-plane-departure",
            searchTerms: [ "airplane", "departing", "destination", "fly", "location", "mode", "take off", "taking off", "travel", "trip" ]
        }, {
            title: "las la-play",
            searchTerms: [ "music", "playing", "sound", "start" ]
        }, {
            title: "las la-play-circle",
            searchTerms: [ "playing", "start" ]
        }, {
            title: "lar la-play-circle",
            searchTerms: [ "playing", "start" ]
        }, {
            title: "lab la-playstation",
            searchTerms: []
        }, {
            title: "las la-plug",
            searchTerms: [ "connect", "online", "power" ]
        }, {
            title: "las la-plus",
            searchTerms: [ "add", "create", "expand", "new", "positive" ]
        }, {
            title: "las la-plus-circle",
            searchTerms: [ "add", "create", "expand", "new", "positive" ]
        }, {
            title: "las la-plus-square",
            searchTerms: [ "add", "create", "expand", "new", "positive" ]
        }, {
            title: "lar la-plus-square",
            searchTerms: [ "add", "create", "expand", "new", "positive" ]
        }, {
            title: "las la-podcast",
            searchTerms: []
        }, {
            title: "las la-poll",
            searchTerms: [ "results", "survey", "vote", "voting" ]
        }, {
            title: "las la-poll-h",
            searchTerms: [ "results", "survey", "vote", "voting" ]
        }, {
            title: "las la-poo",
            searchTerms: []
        }, {
            title: "las la-poo-storm",
            searchTerms: [ "mess", "poop", "shit" ]
        }, {
            title: "las la-poop",
            searchTerms: []
        }, {
            title: "las la-portrait",
            searchTerms: []
        }, {
            title: "las la-pound-sign",
            searchTerms: [ "gbp" ]
        }, {
            title: "las la-power-off",
            searchTerms: [ "on", "reboot", "restart" ]
        }, {
            title: "las la-pray",
            searchTerms: []
        }, {
            title: "las la-praying-hands",
            searchTerms: []
        }, {
            title: "las la-prescription",
            searchTerms: [ "drugs", "medical", "medicine", "rx" ]
        }, {
            title: "las la-prescription-bottle",
            searchTerms: [ "drugs", "medical", "medicine", "rx" ]
        }, {
            title: "las la-prescription-bottle-alt",
            searchTerms: [ "drugs", "medical", "medicine", "rx" ]
        }, {
            title: "las la-print",
            searchTerms: []
        }, {
            title: "las la-procedures",
            searchTerms: []
        }, {
            title: "lab la-product-hunt",
            searchTerms: []
        }, {
            title: "las la-project-diagram",
            searchTerms: []
        }, {
            title: "lab la-pushed",
            searchTerms: []
        }, {
            title: "las la-puzzle-piece",
            searchTerms: [ "add-on", "addon", "section" ]
        }, {
            title: "lab la-python",
            searchTerms: []
        }, {
            title: "lab la-qq",
            searchTerms: []
        }, {
            title: "las la-qrcode",
            searchTerms: [ "scan" ]
        }, {
            title: "las la-question",
            searchTerms: [ "help", "information", "support", "unknown" ]
        }, {
            title: "las la-question-circle",
            searchTerms: [ "help", "information", "support", "unknown" ]
        }, {
            title: "lar la-question-circle",
            searchTerms: [ "help", "information", "support", "unknown" ]
        }, {
            title: "las la-quidditch",
            searchTerms: []
        }, {
            title: "lab la-quinscape",
            searchTerms: []
        }, {
            title: "lab la-quora",
            searchTerms: []
        }, {
            title: "las la-quote-left",
            searchTerms: []
        }, {
            title: "las la-quote-right",
            searchTerms: []
        }, {
            title: "las la-quran",
            searchTerms: [ "book", "islam", "muslim" ]
        }, {
            title: "lab la-r-project",
            searchTerms: []
        }, {
            title: "las la-rainbow",
            searchTerms: []
        }, {
            title: "las la-random",
            searchTerms: [ "shuffle", "sort" ]
        }, {
            title: "lab la-ravelry",
            searchTerms: []
        }, {
            title: "lab la-react",
            searchTerms: []
        }, {
            title: "lab la-reacteurope",
            searchTerms: []
        }, {
            title: "lab la-readme",
            searchTerms: []
        }, {
            title: "lab la-rebel",
            searchTerms: []
        }, {
            title: "las la-receipt",
            searchTerms: [ "check", "invoice", "table" ]
        }, {
            title: "las la-recycle",
            searchTerms: []
        }, {
            title: "lab la-red-river",
            searchTerms: []
        }, {
            title: "lab la-reddit",
            searchTerms: []
        }, {
            title: "lab la-reddit-alien",
            searchTerms: []
        }, {
            title: "lab la-reddit-square",
            searchTerms: []
        }, {
            title: "las la-redo",
            searchTerms: [ "forward", "refresh", "reload", "repeat" ]
        }, {
            title: "las la-redo-alt",
            searchTerms: [ "forward", "refresh", "reload", "repeat" ]
        }, {
            title: "las la-registered",
            searchTerms: []
        }, {
            title: "lar la-registered",
            searchTerms: []
        }, {
            title: "lab la-renren",
            searchTerms: []
        }, {
            title: "las la-reply",
            searchTerms: []
        }, {
            title: "las la-reply-all",
            searchTerms: []
        }, {
            title: "lab la-replyd",
            searchTerms: []
        }, {
            title: "las la-republican",
            searchTerms: [ "american", "conservative", "election", "elephant", "politics", "republican party", "right", "right-wing", "usa" ]
        }, {
            title: "lab la-researchgate",
            searchTerms: []
        }, {
            title: "lab la-resolving",
            searchTerms: []
        }, {
            title: "las la-retweet",
            searchTerms: [ "refresh", "reload", "share", "swap" ]
        }, {
            title: "lab la-rev",
            searchTerms: []
        }, {
            title: "las la-ribbon",
            searchTerms: [ "badge", "cause", "lapel", "pin" ]
        }, {
            title: "las la-ring",
            searchTerms: [ "Dungeons & Dragons", "Gollum", "band", "binding", "d&d", "dnd", "fantasy", "jewelry", "precious" ]
        }, {
            title: "las la-road",
            searchTerms: [ "street" ]
        }, {
            title: "las la-robot",
            searchTerms: []
        }, {
            title: "las la-rocket",
            searchTerms: [ "app" ]
        }, {
            title: "lab la-rocketchat",
            searchTerms: []
        }, {
            title: "lab la-rockrms",
            searchTerms: []
        }, {
            title: "las la-route",
            searchTerms: []
        }, {
            title: "las la-rss",
            searchTerms: [ "blog" ]
        }, {
            title: "las la-rss-square",
            searchTerms: [ "blog", "feed" ]
        }, {
            title: "las la-ruble-sign",
            searchTerms: [ "rub" ]
        }, {
            title: "las la-ruler",
            searchTerms: []
        }, {
            title: "las la-ruler-combined",
            searchTerms: []
        }, {
            title: "las la-ruler-horizontal",
            searchTerms: []
        }, {
            title: "las la-ruler-vertical",
            searchTerms: []
        }, {
            title: "las la-running",
            searchTerms: [ "jog", "sprint" ]
        }, {
            title: "las la-rupee-sign",
            searchTerms: [ "indian", "inr" ]
        }, {
            title: "las la-sad-cry",
            searchTerms: [ "emoticon", "face", "tear", "tears" ]
        }, {
            title: "lar la-sad-cry",
            searchTerms: [ "emoticon", "face", "tear", "tears" ]
        }, {
            title: "las la-sad-tear",
            searchTerms: [ "emoticon", "face", "tear", "tears" ]
        }, {
            title: "lar la-sad-tear",
            searchTerms: [ "emoticon", "face", "tear", "tears" ]
        }, {
            title: "lab la-salari",
            searchTerms: [ "browser" ]
        }, {
            title: "lab la-sass",
            searchTerms: []
        }, {
            title: "las la-save",
            searchTerms: [ "floppy", "floppy-o" ]
        }, {
            title: "lar la-save",
            searchTerms: [ "floppy", "floppy-o" ]
        }, {
            title: "lab la-schlix",
            searchTerms: []
        }, {
            title: "las la-school",
            searchTerms: []
        }, {
            title: "las la-screwdriver",
            searchTerms: [ "admin", "fix", "repair", "settings", "tool" ]
        }, {
            title: "lab la-scribd",
            searchTerms: []
        }, {
            title: "las la-scroll",
            searchTerms: [ "Dungeons & Dragons", "announcement", "d&d", "dnd", "fantasy", "paper" ]
        }, {
            title: "las la-search",
            searchTerms: [ "bigger", "enlarge", "magnify", "preview", "zoom" ]
        }, {
            title: "las la-search-dollar",
            searchTerms: []
        }, {
            title: "las la-search-location",
            searchTerms: []
        }, {
            title: "las la-search-minus",
            searchTerms: [ "minify", "negative", "smaller", "zoom", "zoom out" ]
        }, {
            title: "las la-search-plus",
            searchTerms: [ "bigger", "enlarge", "magnify", "positive", "zoom", "zoom in" ]
        }, {
            title: "lab la-searchengin",
            searchTerms: []
        }, {
            title: "las la-seedling",
            searchTerms: []
        }, {
            title: "lab la-sellcast",
            searchTerms: [ "eercast" ]
        }, {
            title: "lab la-sellsy",
            searchTerms: []
        }, {
            title: "las la-server",
            searchTerms: [ "cpu" ]
        }, {
            title: "lab la-servicestack",
            searchTerms: []
        }, {
            title: "las la-shapes",
            searchTerms: [ "circle", "square", "triangle" ]
        }, {
            title: "las la-share",
            searchTerms: []
        }, {
            title: "las la-share-alt",
            searchTerms: []
        }, {
            title: "las la-share-alt-square",
            searchTerms: []
        }, {
            title: "las la-share-square",
            searchTerms: [ "send", "social" ]
        }, {
            title: "lar la-share-square",
            searchTerms: [ "send", "social" ]
        }, {
            title: "las la-shekel-sign",
            searchTerms: [ "ils" ]
        }, {
            title: "las la-shield-alt",
            searchTerms: [ "achievement", "award", "block", "defend", "security", "winner" ]
        }, {
            title: "las la-ship",
            searchTerms: [ "boat", "sea" ]
        }, {
            title: "las la-shipping-last",
            searchTerms: []
        }, {
            title: "lab la-shirtsinbulk",
            searchTerms: []
        }, {
            title: "las la-shoe-prints",
            searchTerms: [ "feet", "footprints", "steps" ]
        }, {
            title: "las la-shopping-bag",
            searchTerms: []
        }, {
            title: "las la-shopping-basket",
            searchTerms: []
        }, {
            title: "las la-shopping-cart",
            searchTerms: [ "buy", "checkout", "payment", "purchase" ]
        }, {
            title: "lab la-shopware",
            searchTerms: []
        }, {
            title: "las la-shower",
            searchTerms: []
        }, {
            title: "las la-shuttle-van",
            searchTerms: [ "machine", "public-transportation", "transportation", "vehicle" ]
        }, {
            title: "las la-sign",
            searchTerms: []
        }, {
            title: "las la-sign-in-alt",
            searchTerms: [ "arrow", "enter", "join", "log in", "login", "sign in", "sign up", "sign-in", "signin", "signup" ]
        }, {
            title: "las la-sign-language",
            searchTerms: []
        }, {
            title: "las la-sign-out-alt",
            searchTerms: [ "arrow", "exit", "leave", "log out", "logout", "sign-out" ]
        }, {
            title: "las la-signal",
            searchTerms: [ "bars", "graph", "online", "status" ]
        }, {
            title: "las la-signature",
            searchTerms: [ "John Hancock", "cursive", "name", "writing" ]
        }, {
            title: "lab la-simplybuilt",
            searchTerms: []
        }, {
            title: "lab la-sistrix",
            searchTerms: []
        }, {
            title: "las la-sitemap",
            searchTerms: [ "directory", "hierarchy", "ia", "information architecture", "organization" ]
        }, {
            title: "lab la-sith",
            searchTerms: []
        }, {
            title: "las la-skull",
            searchTerms: [ "bones", "skeleton", "yorick" ]
        }, {
            title: "las la-skull-crossbones",
            searchTerms: [ "Dungeons & Dragons", "alert", "bones", "d&d", "danger", "dead", "deadly", "death", "dnd", "fantasy", "halloween", "holiday", "jolly-roger", "pirate", "poison", "skeleton", "warning" ]
        }, {
            title: "lab la-skyatlas",
            searchTerms: []
        }, {
            title: "lab la-skype",
            searchTerms: []
        }, {
            title: "lab la-slack",
            searchTerms: [ "anchor", "hash", "hashtag" ]
        }, {
            title: "lab la-slack-hash",
            searchTerms: [ "anchor", "hash", "hashtag" ]
        }, {
            title: "las la-slash",
            searchTerms: []
        }, {
            title: "las la-sliders-h",
            searchTerms: [ "settings", "sliders" ]
        }, {
            title: "lab la-slideshare",
            searchTerms: []
        }, {
            title: "las la-smile",
            searchTerms: [ "approve", "emoticon", "face", "happy", "rating", "satisfied" ]
        }, {
            title: "lar la-smile",
            searchTerms: [ "approve", "emoticon", "face", "happy", "rating", "satisfied" ]
        }, {
            title: "las la-smile-beam",
            searchTerms: [ "emoticon", "face", "happy", "positive" ]
        }, {
            title: "lar la-smile-beam",
            searchTerms: [ "emoticon", "face", "happy", "positive" ]
        }, {
            title: "las la-smile-wink",
            searchTerms: [ "emoticon", "face", "happy" ]
        }, {
            title: "lar la-smile-wink",
            searchTerms: [ "emoticon", "face", "happy" ]
        }, {
            title: "las la-smog",
            searchTerms: [ "dragon" ]
        }, {
            title: "las la-smoking",
            searchTerms: [ "cigarette", "nicotine", "smoking status" ]
        }, {
            title: "las la-smoking-ban",
            searchTerms: [ "no smoking", "non-smoking" ]
        }, {
            title: "lab la-snapchat",
            searchTerms: []
        }, {
            title: "lab la-snapchat-ghost",
            searchTerms: []
        }, {
            title: "lab la-snapchat-square",
            searchTerms: []
        }, {
            title: "las la-snowflake",
            searchTerms: [ "precipitation", "seasonal", "winter" ]
        }, {
            title: "lar la-snowflake",
            searchTerms: [ "precipitation", "seasonal", "winter" ]
        }, {
            title: "las la-socks",
            searchTerms: [ "business socks", "business time", "flight of the conchords", "wednesday" ]
        }, {
            title: "las la-solar-panel",
            searchTerms: [ "clean", "eco-friendly", "energy", "green", "sun" ]
        }, {
            title: "las la-sort",
            searchTerms: [ "order" ]
        }, {
            title: "las la-sort-alpha-down",
            searchTerms: [ "sort-alpha-asc" ]
        }, {
            title: "las la-sort-alpha-up",
            searchTerms: [ "sort-alpha-desc" ]
        }, {
            title: "las la-sort-amount-down",
            searchTerms: [ "sort-amount-asc" ]
        }, {
            title: "las la-sort-amount-up",
            searchTerms: [ "sort-amount-desc" ]
        }, {
            title: "las la-sort-down",
            searchTerms: [ "arrow", "descending", "sort-desc" ]
        }, {
            title: "las la-sort-numeric-down",
            searchTerms: [ "numbers", "sort-numeric-asc" ]
        }, {
            title: "las la-sort-numeric-up",
            searchTerms: [ "numbers", "sort-numeric-desc" ]
        }, {
            title: "las la-sort-up",
            searchTerms: [ "arrow", "ascending", "sort-asc" ]
        }, {
            title: "lab la-soundcloud",
            searchTerms: []
        }, {
            title: "las la-spa",
            searchTerms: [ "flora", "mindfullness", "plant", "wellness" ]
        }, {
            title: "las la-space-shuttle",
            searchTerms: [ "astronaut", "machine", "nasa", "rocket", "transportation" ]
        }, {
            title: "lab la-speakap",
            searchTerms: []
        }, {
            title: "las la-spider",
            searchTerms: [ "arachnid", "bug", "charlotte", "crawl", "eight", "halloween", "holiday" ]
        }, {
            title: "las la-spinner",
            searchTerms: [ "loading", "progress" ]
        }, {
            title: "las la-splotch",
            searchTerms: []
        }, {
            title: "lab la-spotify",
            searchTerms: []
        }, {
            title: "las la-spray-can",
            searchTerms: []
        }, {
            title: "las la-square",
            searchTerms: [ "block", "box" ]
        }, {
            title: "lar la-square",
            searchTerms: [ "block", "box" ]
        }, {
            title: "las la-square-full",
            searchTerms: []
        }, {
            title: "las la-square-root-alt",
            searchTerms: []
        }, {
            title: "lab la-squarespace",
            searchTerms: []
        }, {
            title: "lab la-stack-exchange",
            searchTerms: []
        }, {
            title: "lab la-stack-overflow",
            searchTerms: []
        }, {
            title: "las la-stamp",
            searchTerms: []
        }, {
            title: "las la-star",
            searchTerms: [ "achievement", "award", "favorite", "important", "night", "rating", "score" ]
        }, {
            title: "lar la-star",
            searchTerms: [ "achievement", "award", "favorite", "important", "night", "rating", "score" ]
        }, {
            title: "las la-star-and-crescent",
            searchTerms: [ "islam", "muslim" ]
        }, {
            title: "las la-star-half",
            searchTerms: [ "achievement", "award", "rating", "score", "star-half-empty", "star-half-full" ]
        }, {
            title: "lar la-star-half",
            searchTerms: [ "achievement", "award", "rating", "score", "star-half-empty", "star-half-full" ]
        }, {
            title: "las la-star-half-alt",
            searchTerms: [ "achievement", "award", "rating", "score", "star-half-empty", "star-half-full" ]
        }, {
            title: "las la-star-of-david",
            searchTerms: [ "jewish", "judaism" ]
        }, {
            title: "las la-star-of-life",
            searchTerms: []
        }, {
            title: "lab la-staylinked",
            searchTerms: []
        }, {
            title: "lab la-steam",
            searchTerms: []
        }, {
            title: "lab la-steam-square",
            searchTerms: []
        }, {
            title: "lab la-steam-symbol",
            searchTerms: []
        }, {
            title: "las la-step-backward",
            searchTerms: [ "beginning", "first", "previous", "rewind", "start" ]
        }, {
            title: "las la-step-forward",
            searchTerms: [ "end", "last", "next" ]
        }, {
            title: "las la-stethoscope",
            searchTerms: []
        }, {
            title: "lab la-sticker-mule",
            searchTerms: []
        }, {
            title: "las la-sticky-note",
            searchTerms: []
        }, {
            title: "lar la-sticky-note",
            searchTerms: []
        }, {
            title: "las la-stop",
            searchTerms: [ "block", "box", "square" ]
        }, {
            title: "las la-stop-circle",
            searchTerms: []
        }, {
            title: "lar la-stop-circle",
            searchTerms: []
        }, {
            title: "las la-stopwatch",
            searchTerms: [ "time" ]
        }, {
            title: "las la-store",
            searchTerms: []
        }, {
            title: "las la-store-alt",
            searchTerms: []
        }, {
            title: "lab la-strava",
            searchTerms: []
        }, {
            title: "las la-stream",
            searchTerms: []
        }, {
            title: "las la-street-view",
            searchTerms: [ "map" ]
        }, {
            title: "las la-strikethrough",
            searchTerms: []
        }, {
            title: "lab la-stripe",
            searchTerms: []
        }, {
            title: "lab la-stripe-s",
            searchTerms: []
        }, {
            title: "las la-stroopwafel",
            searchTerms: [ "dessert", "food", "sweets", "waffle" ]
        }, {
            title: "lab la-studiovinari",
            searchTerms: []
        }, {
            title: "lab la-stumbleupon",
            searchTerms: []
        }, {
            title: "lab la-stumbleupon-circle",
            searchTerms: []
        }, {
            title: "las la-subscript",
            searchTerms: []
        }, {
            title: "las la-subway",
            searchTerms: [ "machine", "railway", "train", "transportation", "vehicle" ]
        }, {
            title: "las la-suitcase",
            searchTerms: [ "baggage", "luggage", "move", "suitcase", "travel", "trip" ]
        }, {
            title: "las la-suitcase-rolling",
            searchTerms: []
        }, {
            title: "las la-sun",
            searchTerms: [ "brighten", "contrast", "day", "lighter", "sol", "solar", "star", "weather" ]
        }, {
            title: "lar la-sun",
            searchTerms: [ "brighten", "contrast", "day", "lighter", "sol", "solar", "star", "weather" ]
        }, {
            title: "lab la-superpowers",
            searchTerms: []
        }, {
            title: "las la-superscript",
            searchTerms: [ "exponential" ]
        }, {
            title: "lab la-supple",
            searchTerms: []
        }, {
            title: "las la-surprise",
            searchTerms: [ "emoticon", "face", "shocked" ]
        }, {
            title: "lar la-surprise",
            searchTerms: [ "emoticon", "face", "shocked" ]
        }, {
            title: "las la-swatchbook",
            searchTerms: []
        }, {
            title: "las la-swimmer",
            searchTerms: [ "athlete", "head", "man", "person", "water" ]
        }, {
            title: "las la-swimming-pool",
            searchTerms: [ "ladder", "recreation", "water" ]
        }, {
            title: "las la-synagogue",
            searchTerms: [ "building", "jewish", "judaism", "star of david", "temple" ]
        }, {
            title: "las la-sync",
            searchTerms: [ "exchange", "refresh", "reload", "rotate", "swap" ]
        }, {
            title: "las la-sync-alt",
            searchTerms: [ "refresh", "reload", "rotate" ]
        }, {
            title: "las la-syringe",
            searchTerms: [ "immunizations", "needle" ]
        }, {
            title: "las la-table",
            searchTerms: [ "data", "excel", "spreadsheet" ]
        }, {
            title: "las la-table-tennis",
            searchTerms: []
        }, {
            title: "las la-tablet",
            searchTerms: [ "apple", "device", "ipad", "kindle", "screen" ]
        }, {
            title: "las la-tablet-alt",
            searchTerms: [ "apple", "device", "ipad", "kindle", "screen" ]
        }, {
            title: "las la-tablets",
            searchTerms: [ "drugs", "medicine" ]
        }, {
            title: "las la-tachometer-alt",
            searchTerms: [ "dashboard", "tachometer" ]
        }, {
            title: "las la-tag",
            searchTerms: [ "label" ]
        }, {
            title: "las la-tags",
            searchTerms: [ "labels" ]
        }, {
            title: "las la-tape",
            searchTerms: []
        }, {
            title: "las la-tasks",
            searchTerms: [ "downloading", "downloads", "loading", "progress", "settings" ]
        }, {
            title: "las la-taxi",
            searchTerms: [ "cab", "cabbie", "car", "car service", "lyft", "machine", "transportation", "uber", "vehicle" ]
        }, {
            title: "lab la-teamspeak",
            searchTerms: []
        }, {
            title: "las la-teeth",
            searchTerms: []
        }, {
            title: "las la-teeth-open",
            searchTerms: []
        }, {
            title: "lab la-telegram",
            searchTerms: []
        }, {
            title: "lab la-telegram-plane",
            searchTerms: []
        }, {
            title: "las la-temperature-high",
            searchTerms: [ "mercury", "thermometer", "warm" ]
        }, {
            title: "las la-temperature-low",
            searchTerms: [ "cool", "mercury", "thermometer" ]
        }, {
            title: "lab la-tencent-weibo",
            searchTerms: []
        }, {
            title: "las la-terminal",
            searchTerms: [ "code", "command", "console", "prompt" ]
        }, {
            title: "las la-text-height",
            searchTerms: []
        }, {
            title: "las la-text-width",
            searchTerms: []
        }, {
            title: "las la-th",
            searchTerms: [ "blocks", "boxes", "grid", "squares" ]
        }, {
            title: "las la-th-large",
            searchTerms: [ "blocks", "boxes", "grid", "squares" ]
        }, {
            title: "las la-th-list",
            searchTerms: [ "checklist", "completed", "done", "finished", "ol", "todo", "ul" ]
        }, {
            title: "lab la-the-red-yeti",
            searchTerms: []
        }, {
            title: "las la-theater-masks",
            searchTerms: []
        }, {
            title: "lab la-themeco",
            searchTerms: []
        }, {
            title: "lab la-themeisle",
            searchTerms: []
        }, {
            title: "las la-thermometer",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "las la-thermometer-empty",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "las la-thermometer-full",
            searchTerms: [ "fever", "mercury", "status", "temperature" ]
        }, {
            title: "las la-thermometer-half",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "las la-thermometer-quarter",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "las la-thermometer-three-quarters",
            searchTerms: [ "mercury", "status", "temperature" ]
        }, {
            title: "lab la-think-peaks",
            searchTerms: []
        }, {
            title: "las la-thumbs-down",
            searchTerms: [ "disagree", "disapprove", "dislike", "hand", "thumbs-o-down" ]
        }, {
            title: "lar la-thumbs-down",
            searchTerms: [ "disagree", "disapprove", "dislike", "hand", "thumbs-o-down" ]
        }, {
            title: "las la-thumbs-up",
            searchTerms: [ "agree", "approve", "favorite", "hand", "like", "ok", "okay", "success", "thumbs-o-up", "yes", "you got it dude" ]
        }, {
            title: "lar la-thumbs-up",
            searchTerms: [ "agree", "approve", "favorite", "hand", "like", "ok", "okay", "success", "thumbs-o-up", "yes", "you got it dude" ]
        }, {
            title: "las la-thumbtack",
            searchTerms: [ "coordinates", "location", "marker", "pin", "thumb-tack" ]
        }, {
            title: "las la-ticket-alt",
            searchTerms: [ "ticket" ]
        }, {
            title: "las la-times",
            searchTerms: [ "close", "cross", "error", "exit", "incorrect", "notice", "notification", "notify", "problem", "wrong", "x" ]
        }, {
            title: "las la-times-circle",
            searchTerms: [ "close", "cross", "exit", "incorrect", "notice", "notification", "notify", "problem", "wrong", "x" ]
        }, {
            title: "lar la-times-circle",
            searchTerms: [ "close", "cross", "exit", "incorrect", "notice", "notification", "notify", "problem", "wrong", "x" ]
        }, {
            title: "las la-tint",
            searchTerms: [ "drop", "droplet", "raindrop", "waterdrop" ]
        }, {
            title: "las la-tint-slash",
            searchTerms: []
        }, {
            title: "las la-tired",
            searchTerms: [ "emoticon", "face", "grumpy" ]
        }, {
            title: "lar la-tired",
            searchTerms: [ "emoticon", "face", "grumpy" ]
        }, {
            title: "las la-toggle-off",
            searchTerms: [ "switch" ]
        }, {
            title: "las la-toggle-on",
            searchTerms: [ "switch" ]
        }, {
            title: "las la-toilet-paper",
            searchTerms: [ "bathroom", "halloween", "holiday", "lavatory", "prank", "restroom", "roll" ]
        }, {
            title: "las la-toolbox",
            searchTerms: [ "admin", "container", "fix", "repair", "settings", "tools" ]
        }, {
            title: "las la-tooth",
            searchTerms: [ "bicuspid", "dental", "molar", "mouth", "teeth" ]
        }, {
            title: "las la-torah",
            searchTerms: [ "book", "jewish", "judaism" ]
        }, {
            title: "las la-torii-gate",
            searchTerms: [ "building", "shintoism" ]
        }, {
            title: "las la-tractor",
            searchTerms: []
        }, {
            title: "lab la-trade-federation",
            searchTerms: []
        }, {
            title: "las la-trademark",
            searchTerms: []
        }, {
            title: "las la-traffic-light",
            searchTerms: []
        }, {
            title: "las la-train",
            searchTerms: [ "bullet", "locomotive", "railway" ]
        }, {
            title: "las la-transgender",
            searchTerms: [ "intersex" ]
        }, {
            title: "las la-transgender-alt",
            searchTerms: []
        }, {
            title: "las la-trash",
            searchTerms: [ "delete", "garbage", "hide", "remove" ]
        }, {
            title: "las la-trash-alt",
            searchTerms: [ "delete", "garbage", "hide", "remove", "trash", "trash-o" ]
        }, {
            title: "lar la-trash-alt",
            searchTerms: [ "delete", "garbage", "hide", "remove", "trash", "trash-o" ]
        }, {
            title: "las la-tree",
            searchTerms: [ "bark", "fall", "flora", "forest", "nature", "plant", "seasonal" ]
        }, {
            title: "lab la-trello",
            searchTerms: []
        }, {
            title: "lab la-tripadvisor",
            searchTerms: []
        }, {
            title: "las la-trophy",
            searchTerms: [ "achievement", "award", "cup", "game", "winner" ]
        }, {
            title: "las la-truck",
            searchTerms: [ "delivery", "shipping" ]
        }, {
            title: "las la-truck-loading",
            searchTerms: []
        }, {
            title: "las la-truck-monster",
            searchTerms: []
        }, {
            title: "las la-truck-moving",
            searchTerms: []
        }, {
            title: "las la-truck-pickup",
            searchTerms: []
        }, {
            title: "las la-tshirt",
            searchTerms: [ "cloth", "clothing" ]
        }, {
            title: "las la-tty",
            searchTerms: []
        }, {
            title: "lab la-tumblr",
            searchTerms: []
        }, {
            title: "lab la-tumblr-square",
            searchTerms: []
        }, {
            title: "las la-tv",
            searchTerms: [ "computer", "display", "monitor", "television" ]
        }, {
            title: "lab la-twitch",
            searchTerms: []
        }, {
            title: "lab la-twitter",
            searchTerms: [ "social network", "tweet" ]
        }, {
            title: "lab la-twitter-square",
            searchTerms: [ "social network", "tweet" ]
        }, {
            title: "lab la-typo3",
            searchTerms: []
        }, {
            title: "lab la-uber",
            searchTerms: []
        }, {
            title: "lab la-uikit",
            searchTerms: []
        }, {
            title: "las la-umbrella",
            searchTerms: [ "protection", "rain" ]
        }, {
            title: "las la-umbrella-beach",
            searchTerms: [ "protection", "recreation", "sun" ]
        }, {
            title: "las la-underline",
            searchTerms: []
        }, {
            title: "las la-undo",
            searchTerms: [ "back", "control z", "exchange", "oops", "return", "rotate", "swap" ]
        }, {
            title: "las la-undo-alt",
            searchTerms: [ "back", "control z", "exchange", "oops", "return", "swap" ]
        }, {
            title: "lab la-uniregistry",
            searchTerms: []
        }, {
            title: "las la-universal-access",
            searchTerms: []
        }, {
            title: "las la-university",
            searchTerms: [ "bank", "institution" ]
        }, {
            title: "las la-unlink",
            searchTerms: [ "chain", "chain-broken", "remove" ]
        }, {
            title: "las la-unlock",
            searchTerms: [ "admin", "lock", "password", "protect" ]
        }, {
            title: "las la-unlock-alt",
            searchTerms: [ "admin", "lock", "password", "protect" ]
        }, {
            title: "lab la-untappd",
            searchTerms: []
        }, {
            title: "las la-upload",
            searchTerms: [ "export", "publish" ]
        }, {
            title: "lab la-usb",
            searchTerms: []
        }, {
            title: "las la-user",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "lar la-user",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "las la-user-alt",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "las la-user-alt-slash",
            searchTerms: []
        }, {
            title: "las la-user-astronaut",
            searchTerms: [ "avatar", "clothing", "cosmonaut", "space", "suit" ]
        }, {
            title: "las la-user-check",
            searchTerms: []
        }, {
            title: "las la-user-circle",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "lar la-user-circle",
            searchTerms: [ "account", "avatar", "head", "human", "man", "person", "profile" ]
        }, {
            title: "las la-user-clock",
            searchTerms: []
        }, {
            title: "las la-user-cog",
            searchTerms: []
        }, {
            title: "las la-user-edit",
            searchTerms: []
        }, {
            title: "las la-user-friends",
            searchTerms: []
        }, {
            title: "las la-user-graduate",
            searchTerms: [ "cap", "clothing", "commencement", "gown", "graduation", "student" ]
        }, {
            title: "las la-user-injured",
            searchTerms: [ "cast", "ouch", "sling" ]
        }, {
            title: "las la-user-lock",
            searchTerms: []
        }, {
            title: "las la-user-md",
            searchTerms: [ "doctor", "job", "medical", "nurse", "occupation", "profile" ]
        }, {
            title: "las la-user-minus",
            searchTerms: [ "delete", "negative", "remove" ]
        }, {
            title: "las la-user-ninja",
            searchTerms: [ "assassin", "avatar", "dangerous", "deadly", "sneaky" ]
        }, {
            title: "las la-user-plus",
            searchTerms: [ "positive", "sign up", "signup" ]
        }, {
            title: "las la-user-secret",
            searchTerms: [ "clothing", "coat", "hat", "incognito", "privacy", "spy", "whisper" ]
        }, {
            title: "las la-user-shield",
            searchTerms: []
        }, {
            title: "las la-user-slash",
            searchTerms: [ "ban", "remove" ]
        }, {
            title: "las la-user-tag",
            searchTerms: []
        }, {
            title: "las la-user-tie",
            searchTerms: [ "avatar", "business", "clothing", "formal" ]
        }, {
            title: "las la-user-times",
            searchTerms: [ "archive", "delete", "remove", "x" ]
        }, {
            title: "las la-users",
            searchTerms: [ "people", "persons", "profiles" ]
        }, {
            title: "las la-users-cog",
            searchTerms: []
        }, {
            title: "lab la-ussunnah",
            searchTerms: []
        }, {
            title: "las la-utensil-spoon",
            searchTerms: [ "spoon" ]
        }, {
            title: "las la-utensils",
            searchTerms: [ "cutlery", "dinner", "eat", "food", "knife", "restaurant", "spoon" ]
        }, {
            title: "lab la-vaadin",
            searchTerms: []
        }, {
            title: "las la-vector-square",
            searchTerms: [ "anchors", "lines", "object" ]
        }, {
            title: "las la-venus",
            searchTerms: [ "female" ]
        }, {
            title: "las la-venus-double",
            searchTerms: []
        }, {
            title: "las la-venus-mars",
            searchTerms: []
        }, {
            title: "lab la-viacoin",
            searchTerms: []
        }, {
            title: "lab la-viadeo",
            searchTerms: []
        }, {
            title: "lab la-viadeo-square",
            searchTerms: []
        }, {
            title: "las la-vial",
            searchTerms: [ "test tube" ]
        }, {
            title: "las la-vials",
            searchTerms: [ "lab results", "test tubes" ]
        }, {
            title: "lab la-viber",
            searchTerms: []
        }, {
            title: "las la-video",
            searchTerms: [ "camera", "film", "movie", "record", "video-camera" ]
        }, {
            title: "las la-video-slash",
            searchTerms: []
        }, {
            title: "las la-vihara",
            searchTerms: [ "buddhism", "buddhist", "building", "monastery" ]
        }, {
            title: "lab la-vimeo",
            searchTerms: []
        }, {
            title: "lab la-vimeo-square",
            searchTerms: []
        }, {
            title: "lab la-vimeo-v",
            searchTerms: [ "vimeo" ]
        }, {
            title: "lab la-vine",
            searchTerms: []
        }, {
            title: "lab la-vk",
            searchTerms: []
        }, {
            title: "lab la-vnv",
            searchTerms: []
        }, {
            title: "las la-volleyball-ball",
            searchTerms: []
        }, {
            title: "las la-volume-down",
            searchTerms: [ "audio", "lower", "music", "quieter", "sound", "speaker" ]
        }, {
            title: "las la-volume-mute",
            searchTerms: []
        }, {
            title: "las la-volume-off",
            searchTerms: [ "audio", "music", "mute", "sound" ]
        }, {
            title: "las la-volume-up",
            searchTerms: [ "audio", "higher", "louder", "music", "sound", "speaker" ]
        }, {
            title: "las la-vote-yea",
            searchTerms: [ "accept", "cast", "election", "politics", "positive", "yes" ]
        }, {
            title: "las la-vr-cardboard",
            searchTerms: [ "google", "reality", "virtual" ]
        }, {
            title: "lab la-vuejs",
            searchTerms: []
        }, {
            title: "las la-walking",
            searchTerms: []
        }, {
            title: "las la-wallet",
            searchTerms: []
        }, {
            title: "las la-warehouse",
            searchTerms: []
        }, {
            title: "las la-water",
            searchTerms: []
        }, {
            title: "lab la-weebly",
            searchTerms: []
        }, {
            title: "lab la-weibo",
            searchTerms: []
        }, {
            title: "las la-weight",
            searchTerms: [ "measurement", "scale", "weight" ]
        }, {
            title: "las la-weight-hanging",
            searchTerms: [ "anvil", "heavy", "measurement" ]
        }, {
            title: "lab la-weixin",
            searchTerms: []
        }, {
            title: "lab la-whatsapp",
            searchTerms: []
        }, {
            title: "lab la-whatsapp-square",
            searchTerms: []
        }, {
            title: "las la-wheelchair",
            searchTerms: [ "handicap", "person" ]
        }, {
            title: "lab la-whmcs",
            searchTerms: []
        }, {
            title: "las la-wifi",
            searchTerms: []
        }, {
            title: "lab la-wikipedia-w",
            searchTerms: []
        }, {
            title: "las la-wind",
            searchTerms: [ "air", "blow", "breeze", "fall", "seasonal" ]
        }, {
            title: "las la-window-close",
            searchTerms: []
        }, {
            title: "lar la-window-close",
            searchTerms: []
        }, {
            title: "las la-window-maximize",
            searchTerms: []
        }, {
            title: "lar la-window-maximize",
            searchTerms: []
        }, {
            title: "las la-window-minimize",
            searchTerms: []
        }, {
            title: "lar la-window-minimize",
            searchTerms: []
        }, {
            title: "las la-window-restore",
            searchTerms: []
        }, {
            title: "lar la-window-restore",
            searchTerms: []
        }, {
            title: "lab la-windows",
            searchTerms: [ "microsoft" ]
        }, {
            title: "las la-wine-bottle",
            searchTerms: [ "alcohol", "beverage", "drink", "glass", "grapes" ]
        }, {
            title: "las la-wine-glass",
            searchTerms: [ "alcohol", "beverage", "drink", "grapes" ]
        }, {
            title: "las la-wine-glass-alt",
            searchTerms: [ "alcohol", "beverage", "drink", "grapes" ]
        }, {
            title: "lab la-wix",
            searchTerms: []
        }, {
            title: "lab la-wizards-of-the-coast",
            searchTerms: [ "Dungeons & Dragons", "d&d", "dnd", "fantasy", "game", "gaming", "tabletop" ]
        }, {
            title: "lab la-wolf-pack-battalion",
            searchTerms: []
        }, {
            title: "las la-won-sign",
            searchTerms: [ "krw" ]
        }, {
            title: "lab la-wordpress",
            searchTerms: []
        }, {
            title: "lab la-wordpress-simple",
            searchTerms: []
        }, {
            title: "lab la-wpbeginner",
            searchTerms: []
        }, {
            title: "lab la-wpexplorer",
            searchTerms: []
        }, {
            title: "lab la-wpforms",
            searchTerms: []
        }, {
            title: "lab la-wpressr",
            searchTerms: [ "rendact" ]
        }, {
            title: "las la-wrench",
            searchTerms: [ "fix", "settings", "spanner", "tool", "update" ]
        }, {
            title: "las la-x-ray",
            searchTerms: [ "radiological images", "radiology" ]
        }, {
            title: "lab la-xbox",
            searchTerms: []
        }, {
            title: "lab la-xing",
            searchTerms: []
        }, {
            title: "lab la-xing-square",
            searchTerms: []
        }, {
            title: "lab la-y-combinator",
            searchTerms: []
        }, {
            title: "lab la-yahoo",
            searchTerms: []
        }, {
            title: "lab la-yandex",
            searchTerms: []
        }, {
            title: "lab la-yandex-international",
            searchTerms: []
        }, {
            title: "lab la-yelp",
            searchTerms: []
        }, {
            title: "las la-yen-sign",
            searchTerms: [ "jpy", "money" ]
        }, {
            title: "las la-yin-yang",
            searchTerms: [ "daoism", "opposites", "taoism" ]
        }, {
            title: "lab la-yoast",
            searchTerms: []
        }, {
            title: "lab la-youtube",
            searchTerms: [ "film", "video", "youtube-play", "youtube-square" ]
        }, {
            title: "lab la-youtube-square",
            searchTerms: []
        },{
            title: "lab la-zhihu",
            searchTerms: []
        },{
            title: "fa-brands fa-x-twitter",
            searchTerms: ['x','twitter']
        },{
            title: "fa-brands fa-square-x-twitter",
            searchTerms: ['x','twitter']
        }
    ]
    });
});