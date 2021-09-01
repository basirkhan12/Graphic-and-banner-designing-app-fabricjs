"use strict";
! function(a) {
    var b = a.fabric || (a.fabric = {}),
        c = "1.6.0",
        d = function() {
            return "undefined" != typeof G_vmlCanvasManager
        },
        e = b.util.degreesToRadians,
        f = {
            mt: 0,
            tr: 1,
            mr: 2,
            br: 3,
            mb: 4,
            bl: 5,
            ml: 6,
            tl: 7
        };
    c.localeCompare(a.fabric.version) > -1 && console.warn("this extension might not be fully compatible with your version of fabric.js (" + a.fabric.version + ").Consider using the latest compatible build of fabric.js (> " + c + ")"), b.util.object.extend(b.Object.prototype, {
        useCustomIcons: !1,
        cornerBackgroundColor: "transparent",
        cornerShape: "",
        cornerPadding: 0,
        customiseCornerIcons: function(a, b) {
            var c, d;
            for (c in a) a.hasOwnProperty(c) && (d = {}, void 0 !== a[c].cornerShape && (this.cornerShape = a[c].cornerShape), void 0 !== a[c].cornerBackgroundColor && (this.cornerBackgroundColor = a[c].cornerBackgroundColor), void 0 !== a[c].borderColor && (this.borderColor = a[c].borderColor), void 0 !== a[c].cornerSize && (this.cornerSize = a[c].cornerSize), void 0 !== a[c].cornerPadding && (this.cornerPadding = a[c].cornerPadding), void 0 === a[c].icon && "settings" !== Object.keys(a)[0] || (this.useCustomIcons = !0, void 0 !== a[c].settings && (d.settings = a[c].settings), void 0 !== a[c].icon && (d.icon = a[c].icon, this.loadIcon(c, d, function() {
                b && "function" == typeof b && b()
            }))))
        },
        loadIcon: function(a, c, d) {
            var e = this,
                f = new Image;
            f.onload = function() {
                e[a + "Icon"] = this, c.settings && (e[a + "Settings"] = c.settings), d && "function" == typeof d && d()
            }, f.onerror = function() {
                b.warn(this.src + " icon is not an image")
            }, (c.icon.match(/^http[s]?:\/\//) || "//" === c.icon.substring(0, 2)) && (f.crossOrigin = "Anonymous"), f.src = c.icon
        },
        customizeCornerIcons: function(a) {
            this.customiseCornerIcons(a)
        },
        drawControls: function(a) {
            if (!this.hasControls) return this;
            var b, c = this._calculateCurrentDimensions(),
                d = c.x,
                e = c.y,
                f = this.cornerSize,
                g = -(d + f) / 2,
                h = -(e + f) / 2;
            return this.useCustomIcons ? b = "drawImage" : (a.lineWidth = 1, a.globalAlpha = this.isMoving ? this.borderOpacityWhenMoving : 1, a.strokeStyle = a.fillStyle = this.cornerColor, this.transparentCorners || (a.strokeStyle = this.cornerStrokeColor), b = this.transparentCorners ? "stroke" : "fill"), a.save(), this._setLineDash(a, this.cornerDashArray, null), this._drawControl("tl", a, b, g, h, this.tlIcon, this.tlSettings), this._drawControl("tr", a, b, g + d, h, this.trIcon, this.trSettings), this._drawControl("bl", a, b, g, h + e, this.blIcon, this.blSettings), this._drawControl("br", a, b, g + d, h + e, this.brIcon, this.brSettings), this.get("lockUniScaling") || (this._drawControl("mt", a, b, g + d / 2, h, this.mtIcon, this.mtSettings), this._drawControl("mb", a, b, g + d / 2, h + e, this.mbIcon, this.mbSettings), this._drawControl("mr", a, b, g + d, h + e / 2, this.mrIcon, this.mrSettings), this._drawControl("ml", a, b, g, h + e / 2, this.mlIcon, this.mlSettings)), this.hasRotatingPoint && this._drawControl("mtr", a, b, g + d / 2, h - this.rotatingPointOffset, this.mtrIcon, this.mtrSettings), a.restore(), this
        },
        _drawControl: function(a, b, c, e, f, g, h) {
            if (this.isControlVisible(a)) {
                var i = this.cornerSize,
                    j = this.cornerStrokeColor || "transparent",
                    k = this.cornerBackgroundColor || "black",
                    l = this.cornerShape || "rect",
                    m = this.cornerPadding || 10;
                if (h && (h.cornerSize && (e = e + i / 2 - h.cornerSize / 2, f = f + i / 2 - h.cornerSize / 2, i = h.cornerSize), l = h.cornerShape || l, k = h.cornerBackgroundColor || k, m = h.cornerPadding || m, j = h.cornerStrokeColor || j), this.useCustomIcons)
                    if (l) {
                        switch (b.globalAlpha = 1, b.fillStyle = k, b.lineWidth = 1, b.strokeStyle = j, l) {
                            case "rect":
                                b.fillRect(e, f, i, i), j && b.strokeRect(e, f, i, i);
                                break;
                            case "circle":
                                b.beginPath(), b.arc(e + i / 2, f + i / 2, i / 2, 0, 2 * Math.PI), b.fill(), j && b.stroke(), b.closePath()
                        }
                        void 0 !== g && b[c](g, e + m / 2, f + m / 2, i - m, i - m)
                    } else void 0 !== g && b[c](g, e, f, i, i);
                else d() || this.transparentCorners || b.clearRect(e, f, i, i), b[c + "Rect"](e, f, i, i), !this.transparentCorners && j && b.strokeRect(e, f, i, i)
            }
        }
    }), b.util.object.extend(b.Canvas.prototype, {
        overwriteActions: !1,
        fixedCursors: !1,
        customiseControls: function(a) {
            var b;
            for (b in a) a.hasOwnProperty(b) && (void 0 !== a[b].action && (this.overwriteActions = !0, this.setCustomAction(b, a[b].action)), void 0 !== a[b].cursor && (this.fixedCursors = !0, this.setCustomCursor(b, a[b].cursor)))
        },
        setCustomAction: function(a, b) {
            this[a + "Action"] = b
        },
        setCustomCursor: function(a, b) {
            this[a + "cursorIcon"] = b
        },
        customizeControls: function(a) {
            this.customiseControls(a)
        },
        _getActionFromCorner: function(a, b, c) {
            if (!b) return "drag";
            if (b)
                if (this[b + "Action"] && this.overwriteActions) switch (b) {
                    case "mtr":
                        return this[b + "Action"] || "rotate";
                    case "ml":
                    case "mr":
                        return c[this.altActionKey] ? c[this.altActionKey] ? "skewY" : "scaleX" : this[b + "Action"];
                    case "mt":
                    case "mb":
                        return c[this.altActionKey] ? c[this.altActionKey] ? "skewY" : "scaleY" : this[b + "Action"];
                    default:
                        return this[b + "Action"] || "scale"
                } else switch (b) {
                    case "mtr":
                        return "rotate";
                    case "ml":
                    case "mr":
                        return c[this.altActionKey] ? "skewY" : "scaleX";
                    case "mt":
                    case "mb":
                        return c[this.altActionKey] ? "skewX" : "scaleY";
                    default:
                        return "scale"
                }
                return !1
        },
        _setupCurrentTransform: function(a, b) {
            if (b) {
                var c = this.getPointer(a),
                    d = b._findTargetCorner(this.getPointer(a, !0)),
                    f = this._getActionFromCorner(b, d, a),
                    g = this._getOriginFromCorner(b, d);
                "function" == typeof f && (f.call(this, a, b), f = "void"), this._currentTransform = {
                    target: b,
                    action: f,
                    corner: d,
                    scaleX: b.scaleX,
                    scaleY: b.scaleY,
                    skewX: b.skewX,
                    skewY: b.skewY,
                    offsetX: c.x - b.left,
                    offsetY: c.y - b.top,
                    originX: g.x,
                    originY: g.y,
                    ex: c.x,
                    ey: c.y,
                    lastX: c.x,
                    lastY: c.y,
                    left: b.left,
                    top: b.top,
                    theta: e(b.angle),
                    width: b.width * b.scaleX,
                    mouseXSign: 1,
                    mouseYSign: 1,
                    shiftKey: a.shiftKey,
                    altKey: a[this.centeredKey]
                }, this._currentTransform.original = {
                    left: b.left,
                    top: b.top,
                    scaleX: b.scaleX,
                    scaleY: b.scaleY,
                    skewX: b.skewX,
                    skewY: b.skewY,
                    originX: g.x,
                    originY: g.y
                }, "remove" === f && this._removeAction(a, b), "moveUp" === f && this._moveLayerUpAction(a, b), "moveDown" === f && this._moveLayerDownAction(a, b), "object" == typeof f && "rotateByDegrees" === Object.keys(f)[0] && this._rotateByDegrees(a, b, f.rotateByDegrees), this._resetCurrentTransform()
            }
        },
        _removeAction: function(a, b) {
            var c = this;
            this.getActiveGroup() && "undefined" !== this.getActiveGroup() ? (this.getActiveGroup().forEachObject(function(a) {
                a.off(), a.remove()
            }), this.discardActiveGroup(), setTimeout(function() {
                c.deactivateAll()
            }, 0)) : (b.off(), b.remove(), setTimeout(function() {
                c.deactivateAll()
            }, 0))
        },
        _moveLayerUpAction: function(a, b) {
            this.getActiveGroup() && "undefined" !== this.getActiveGroup() ? this.getActiveGroup().forEachObject(function(a) {
                a.bringForward()
            }) : b.bringForward()
        },
        _moveLayerDownAction: function(a, b) {
            this.getActiveGroup() && "undefined" !== this.getActiveGroup() ? this.getActiveGroup().forEachObject(function(a) {
                a.sendBackwards()
            }) : b.sendBackwards()
        },
        _rotateByDegrees: function(a, b, c) {
            var d = parseInt(b.getAngle()) + c,
                e = !1;
            "center" === b.originX && "center" === b.originY || !b.centeredRotation || (this._setOriginToCenter(b), e = !0), d = d > 360 ? d - 360 : d, this.getActiveGroup() && "undefined" !== this.getActiveGroup() ? this.getActiveGroup().forEachObject(function(a) {
                a.setAngle(d).setCoords()
            }) : b.setAngle(d).setCoords(), e && this._setCenterToOrigin(b), this.renderAll()
        },
        _setCornerCursor: function(a, b, c) {
            if (this.fixedCursors && this[a + "cursorIcon"]) this[a + "cursorIcon"].match(/\.(?:jpe?g|png|gif|jpg|jpeg|svg)$/) ? this.setCursor("url(" + this[a + "cursorIcon"] + "), auto") : "resize" === this[a + "cursorIcon"] ? this.setCursor(this._getRotatedCornerCursor(a, b, c)) : this.setCursor(this[a + "cursorIcon"]);
            else if (a in f) this.setCursor(this._getRotatedCornerCursor(a, b, c));
            else {
                if ("mtr" !== a || !b.hasRotatingPoint) return this.setCursor(this.defaultCursor), !1;
                this.setCursor(this.rotationCursor)
            }
            return !1
        }
    }), "undefined" != typeof exports && (module.exports = this)
}(window);
