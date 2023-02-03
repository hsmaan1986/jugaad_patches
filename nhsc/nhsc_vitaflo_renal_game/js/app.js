(function ($, Drupal, drupalSettings) {

    /*eslint no-console:0*/

    "use strict";

    Drupal.renal_game_behavours = {};
    Drupal.behaviors.renal_game_behavours = {
        attach: function (context, settings) {

            var data = drupalSettings.renal_game_data;

            console.log('data', drupalSettings);
            var asset_path = data.asset_path;

            ! function() {
                "use strict";
                var e = "undefined" == typeof global ? self : global;
                if ("function" != typeof e.require) {
                    var t = {},
                        s = {},
                        a = {},
                        i = {}.hasOwnProperty,
                        o = /^\.\.?(\/|$)/,
                        n = function(e, t) {
                            for (var s, a = [], i = (o.test(t) ? e + "/" + t : t).split("/"), n = 0, l = i.length; n < l; n++) s = i[n], ".." === s ? a.pop() : "." !== s && "" !== s && a.push(s);
                            return a.join("/")
                        },
                        l = function(e) {
                            return e.split("/").slice(0, -1).join("/")
                        },
                        r = function(t) {
                            return function(s) {
                                var a = n(l(t), s);
                                return e.require(a, t)
                            }
                        },
                        u = function(e, t) {
                            var a = _ && _.createHot(e),
                                i = {
                                    id: e,
                                    exports: {},
                                    hot: a
                                };
                            return s[e] = i, t(i.exports, r(e), i), i.exports
                        },
                        h = function(e) {
                            return a[e] ? h(a[e]) : e
                        },
                        c = function(e, t) {
                            return h(n(l(e), t))
                        },
                        p = function(e, a) {
                            null == a && (a = "/");
                            var o = h(e);
                            if (i.call(s, o)) return s[o].exports;
                            if (i.call(t, o)) return u(o, t[o]);
                            throw new Error("Cannot find module '" + e + "' from '" + a + "'")
                        };
                    p.alias = function(e, t) {
                        a[t] = e
                    };
                    var d = /\.[^.\/]+$/,
                        g = /\/index(\.[^\/]+)?$/,
                        f = function(e) {
                            if (d.test(e)) {
                                var t = e.replace(d, "");
                                i.call(a, t) && a[t].replace(d, "") !== t + "/index" || (a[t] = e)
                            }
                            if (g.test(e)) {
                                var s = e.replace(g, "");
                                i.call(a, s) || (a[s] = e)
                            }
                        };
                    p.register = p.define = function(e, a) {
                        if (e && "object" == typeof e)
                            for (var o in e) i.call(e, o) && p.register(o, e[o]);
                        else t[e] = a, delete s[e], f(e)
                    }, p.list = function() {
                        var e = [];
                        for (var s in t) i.call(t, s) && e.push(s);
                        return e
                    };
                    var _ = e._hmr && new e._hmr(c, p, t, s);
                    p._cache = s, p.hmr = _ && _.wrap, p.brunch = !0, e.require = p
                }
            }(),
                function() {
                    var e;
                    "undefined" == typeof window ? this : window;
                    require.register("data/const.js", function(e, t, s) {
                        "use strict";
                        Object.defineProperty(e, "__esModule", {
                            value: !0
                        }), e["default"] = void 0;
                        var a = Object.freeze({
                            colors: Object.freeze({
                                aqua: "#62f6ff",
                                black: "#000",
                                gold: "#fed141",
                                white: "#fff"
                            }),
                            fonts: Object.freeze({
                                "default": "Futura, system-ui, sans-serif"
                            }),
                            hexColors: Object.freeze({
                                darkGray: 2236962,
                                red: 16720384,
                                white: 16777215
                            })
                        });
                        e["default"] = a
                    }), require.register("data/levels.js", function(e, t, s) {
                        "use strict";

                        function a(e) {
                            return e && e.__esModule ? e : {
                                "default": e
                            }
                        }
                        Object.defineProperty(e, "__esModule", {
                            value: !0
                        }), e["default"] = void 0;
                        var i = a(t("./strings")),
                            o = Object.freeze([Object.freeze({
                                title: "Potassium",
                                levels: [{
                                    id: 1,
                                    level_progress: "ui-level_progress-1",
                                    title: "Banana Smash",
                                    title_colour: "#ffde16",
                                    good: "apple",
                                    bad: "banana",
                                    message: i["default"].levels.potassium.banana,
                                    message_size: "142px",
                                    goal: 8,
                                    total: 16,
                                    splat: "Bananas",
                                    oops: "Oops! You\nSmashed an Apple",
                                    too_many_good: "You smashed too many Apples!",
                                    goal_colour: "#F7941D",
                                    ui_splat_texture: "ui-splat_potassium",
                                    ui_splat_x: 15,
                                    splat_size: "80px",
                                    splat_x: 170,
                                    splat_y: 80,
                                    oops_x: -230,
                                    oops_y: -137,
                                    end_splat_scale: .8,
                                    count_offset: 0,
                                    spawn_interval: 1100,
                                    item_speed: 3e3,
                                    random_rotation: !0
                                }, {
                                    id: 2,
                                    level_progress: "ui-level_progress-2",
                                    title: "Tomato Smash",
                                    title_colour: "#EF4136",
                                    good: "broccoli",
                                    bad: "tomato",
                                    message: i["default"].levels.potassium.tomato,
                                    message_size: "164px",
                                    goal: 5,
                                    total: 20,
                                    splat: "Tomatoes",
                                    oops: "Oops! You\nSmashed a Broccoli",
                                    too_many_good: "You smashed too many Broccoli!",
                                    goal_colour: "#FFFFFF",
                                    ui_splat_texture: "ui-splat_tomato",
                                    ui_splat_x: 23,
                                    splat_size: "80px",
                                    splat_x: 170,
                                    splat_y: 80,
                                    oops_x: -230,
                                    oops_y: -137,
                                    end_splat_scale: .8,
                                    count_offset: 0,
                                    spawn_interval: 1100,
                                    item_speed: 2600,
                                    random_rotation: !0
                                }, {
                                    id: 3,
                                    level_progress: "ui-level_progress-3",
                                    title: "Chocolate Smash",
                                    title_colour: "#3B0015",
                                    title_offset_x: -20,
                                    title_image_offset_x: 10,
                                    title_image_offset_y: 20,
                                    good: "marshmallow",
                                    bad: "chocolate",
                                    message: i["default"].levels.potassium.chocolate,
                                    message_size: "164px",
                                    goal: 5,
                                    total: 12,
                                    splat: "Chocolate Bars",
                                    oops: "Oops! You\nSmashed a Marshmallow",
                                    too_many_good: "You smashed too many Marshmallows!",
                                    goal_colour: "#C5B3B4",
                                    ui_splat_texture: "ui-splat_chocolate",
                                    ui_splat_x: 25,
                                    splat_size: "60px",
                                    splat_x: 160,
                                    splat_y: 85,
                                    oops_x: -260,
                                    oops_y: -137,
                                    end_splat_scale: .97,
                                    count_offset: 10,
                                    spawn_interval: 1100,
                                    item_speed: 2300,
                                    random_rotation: !0
                                }]
                            }), Object.freeze({
                                title: "Phosphate",
                                levels: [{
                                    id: 1,
                                    level_progress: "ui-level_progress-4",
                                    title: "Cheese Smash",
                                    title_colour: "#ffde16",
                                    good: "cream_cheese",
                                    bad: "hard_cheese",
                                    message: i["default"].levels.phosphate.cheese,
                                    message_size: "124px",
                                    goal: 8,
                                    total: 20,
                                    splat: "Hard Cheeses",
                                    oops: "Oops! You\nSmashed a Cream Cheese",
                                    too_many_good: "You smashed too many Cream Cheese!",
                                    goal_colour: "#F7941D",
                                    ui_splat_texture: "ui-splat_potassium",
                                    ui_splat_x: 15,
                                    splat_size: "70px",
                                    splat_x: 155,
                                    splat_y: 83,
                                    oops_x: -260,
                                    oops_y: -137,
                                    end_splat_scale: .8,
                                    count_offset: 0,
                                    spawn_interval: 1e3,
                                    item_speed: 2700,
                                    random_rotation: !0
                                }, {
                                    id: 2,
                                    level_progress: "ui-level_progress-5",
                                    title: "Chocolate Smash",
                                    title_colour: "#3B0015",
                                    title_offset_x: -20,
                                    title_image_offset_x: 10,
                                    title_image_offset_y: 20,
                                    good: "jelly_sweets",
                                    bad: "chocolate",
                                    message: i["default"].levels.phosphate.chocolate,
                                    message_size: "164px",
                                    goal: 12,
                                    total: 20,
                                    splat: "Chocolate Bars",
                                    oops: "Oops! You\nSmashed Jelly Sweets",
                                    too_many_good: "You smashed too many Jelly Sweets!",
                                    goal_colour: "#C5B3B4",
                                    ui_splat_texture: "ui-splat_chocolate",
                                    ui_splat_x: 25,
                                    splat_size: "60px",
                                    splat_x: 160,
                                    splat_y: 85,
                                    oops_x: -250,
                                    oops_y: -137,
                                    end_splat_scale: .97,
                                    count_offset: 10,
                                    spawn_interval: 1e3,
                                    item_speed: 2600,
                                    random_rotation: !0
                                }, {
                                    id: 3,
                                    level_progress: "ui-level_progress-6",
                                    title: "Hot Chocolate Smash",
                                    title_offset_x: -30,
                                    title_image_offset_x: 20,
                                    title_image_offset_y: 50,
                                    title_colour: "#8B5E3C",
                                    good: "lemonade",
                                    bad: "hot_chocolate",
                                    message: i["default"].levels.phosphate.hot_chocolate,
                                    message_size: "164px",
                                    goal: 8,
                                    total: 15,
                                    splat: "Hot Chocolates",
                                    oops: "Oops! You\nSmashed Lemonade",
                                    too_many_good: "You smashed too many Lemonades!",
                                    goal_colour: "#D0B7A1",
                                    ui_splat_texture: "ui-splat_hot_chocolate",
                                    ui_splat_x: 25,
                                    splat_size: "60px",
                                    splat_x: 150,
                                    splat_y: 85,
                                    oops_x: -240,
                                    oops_y: -137,
                                    end_splat_scale: .9,
                                    count_offset: 0,
                                    spawn_interval: 1e3,
                                    item_speed: 2500,
                                    random_rotation: !1
                                }, {
                                    id: 4,
                                    level_progress: "ui-level_progress-7",
                                    title: "Fast Food Smash",
                                    title_colour: "#BF4335",
                                    title_image_offset_y: 30,
                                    good: "home_cooked",
                                    bad: "fast_food",
                                    message: i["default"].levels.phosphate.fast_food,
                                    message_size: "164px",
                                    goal: 8,
                                    total: 10,
                                    splat: "Fast Food",
                                    oops: "Oops! You Smashed\nA Home Cooked Meal",
                                    too_many_good: "You smashed too many Home Cooked Meals!",
                                    goal_colour: "#FFFFFF",
                                    ui_splat_texture: "ui-splat_fast_food",
                                    ui_splat_x: 20,
                                    splat_size: "60px",
                                    splat_x: 160,
                                    splat_y: 85,
                                    oops_x: -240,
                                    oops_y: -137,
                                    end_splat_scale: .9,
                                    count_offset: 10,
                                    spawn_interval: 1e3,
                                    item_speed: 2400,
                                    random_rotation: !0
                                }]
                            }), Object.freeze({
                                title: "Salt",
                                levels: [{
                                    id: 1,
                                    level_progress: "ui-level_progress-8",
                                    title: "Condiment Smash",
                                    title_colour: "#F6F4B2",
                                    title_image_offset_x: 10,
                                    title_image_offset_y: 50,
                                    good: "pepper",
                                    bad: "salt",
                                    message: i["default"].levels.salt.condiment,
                                    message_size: "124px",
                                    goal: 15,
                                    total: 20,
                                    splat: "Salt Shakers",
                                    oops: "Oops! You Smashed\na Pepper Shaker",
                                    too_many_good: "You smashed too many Pepper Shakers!",
                                    goal_colour: "#8DC63F",
                                    ui_splat_texture: "ui-splat_salt",
                                    ui_splat_x: 25,
                                    splat_size: "70px",
                                    splat_x: 160,
                                    splat_y: 83,
                                    oops_x: -240,
                                    oops_y: -137,
                                    end_splat_scale: .97,
                                    count_offset: 10,
                                    spawn_interval: 900,
                                    item_speed: 2600,
                                    random_rotation: !0
                                }, {
                                    id: 2,
                                    level_progress: "ui-level_progress-9",
                                    title: "Bacon & Sausage Smash",
                                    title_offset_x: -10,
                                    title_image_offset_x: 20,
                                    title_image_offset_y: 50,
                                    title_colour: "#BF4335",
                                    good: "chicken",
                                    bad: "bacon",
                                    message: i["default"].levels.salt.bacon,
                                    message_size: "154px",
                                    goal: 8,
                                    total: 20,
                                    splat: "Bacon & Sausages",
                                    oops: "Oops! You\nSmashed Chicken",
                                    too_many_good: "You smashed too much Chicken!",
                                    goal_colour: "#FFFFFF",
                                    ui_splat_texture: "ui-splat_fast_food",
                                    ui_splat_x: 25,
                                    splat_size: "60px",
                                    splat_x: 150,
                                    splat_y: 85,
                                    oops_x: -220,
                                    oops_y: -137,
                                    end_splat_scale: .97,
                                    count_offset: 10,
                                    spawn_interval: 900,
                                    item_speed: 2400,
                                    random_rotation: !0
                                }, {
                                    id: 3,
                                    level_progress: "ui-level_progress-10",
                                    title: "Takeaway Smash",
                                    title_offset_x: -10,
                                    title_image_offset_x: 10,
                                    title_image_offset_y: 50,
                                    title_colour: "#BE1E2D",
                                    good: "pasta",
                                    bad: "takeaway",
                                    message: i["default"].levels.salt.takeaways,
                                    message_size: "154px",
                                    goal: 8,
                                    total: 12,
                                    splat: "Takeaways",
                                    oops: "Oops! You\nSmashed Pasta",
                                    too_many_good: "You smashed too much Pasta!",
                                    goal_colour: "#FFFFFF",
                                    ui_splat_texture: "ui-splat_tomato",
                                    ui_splat_x: 25,
                                    splat_size: "60px",
                                    splat_x: 150,
                                    splat_y: 85,
                                    oops_x: -220,
                                    oops_y: -137,
                                    end_splat_scale: .9,
                                    count_offset: 0,
                                    spawn_interval: 900,
                                    item_speed: 2200,
                                    random_rotation: !0
                                }, {
                                    id: 4,
                                    level_progress: "ui-level_progress-11",
                                    title: "Salty Snack Smash",
                                    title_offset_x: -20,
                                    title_image_offset_x: 15,
                                    title_image_offset_y: 45,
                                    title_colour: "#BF4335",
                                    good: "right_snacks",
                                    bad: "salty_snacks",
                                    message: i["default"].levels.salt.salty_snacks,
                                    message_size: "154px",
                                    goal: 8,
                                    total: 20,
                                    splat: "Salty Snacks",
                                    oops: "Oops! You Smashed\nThe Right Snacks",
                                    too_many_good: "You smashed too much of the right snacks!",
                                    goal_colour: "#FFFFFF",
                                    ui_splat_texture: "ui-splat_salty_snacks",
                                    ui_splat_x: 20,
                                    splat_size: "60px",
                                    splat_x: 150,
                                    splat_y: 85,
                                    oops_x: -230,
                                    oops_y: -137,
                                    end_splat_scale: .8,
                                    count_offset: 0,
                                    spawn_interval: 900,
                                    item_speed: 2e3,
                                    random_rotation: !0
                                }]
                            })]);
                        e["default"] = o
                    }), require.register("data/strings.js", function(e, t, s) {
                        "use strict";
                        Object.defineProperty(e, "__esModule", {
                            value: !0
                        }), e["default"] = void 0;
                        var a = Object.freeze({
                            instructions: "This game is designed to be a fun way to educate you on dietary aspects for kidney disease. However, as individual nutritional needs and dietary restrictions can vary, it is important to always check with your dietitian regarding which foods and drinks you can have.",
                            how_to_play: "Use your mouse to move the spatula and then click it to smash the food or drink items on each level.",
                            levels: Object.freeze({
                                potassium: Object.freeze({
                                    banana: "If you have been advised to follow a low potassium diet you will need to reduce your intake of high potassium foods. Bananas are high in potassium so make sure none of them land in your basket",
                                    tomato: "Tomatoes are high in Potassium. So make sure none of them land in your basket.",
                                    chocolate: "Chocolate is high in potassium. So make sure no chocolate bars land in your basket."
                                }),
                                phosphate: Object.freeze({
                                    cheese: "If you have been advised to follow a low phosphate diet you will need to reduce your intake of high phosphate foods and those foods which contain phosphate additives. Hard Cheese is high in phosphate. So make sure no hard cheese lands in your basket.",
                                    chocolate: "Chocolate is high in Phosphate. So make sure no Chocolate Bars land in your basket.",
                                    hot_chocolate: "Hot chocolate is high in Phosphate. So make sure none of it lands in your basket.",
                                    fast_food: "Fast Foods such as Cheese Burgers contain Phosphate Additives. So Make sure no Fast Food lands in your basket."
                                }),
                                salt: Object.freeze({
                                    condiment: "If you have been advised to follow a low salt diet, you need to avoid adding salt to food and also avoid foods which are high in salt. Make sure no salt shakers land in your basket.",
                                    bacon: "Bacon & Sausages contain high levels of salt. So make sure no bacon or sausages land in your basket.",
                                    takeaways: "Takeaways and Prepackaged Meals are high in salt. So make sure no Takeaways land in your basket.",
                                    salty_snacks: "Salty snacks are high in salt. So make sure no salty snacks land in your basket."
                                })
                            })
                        });
                        e["default"] = a
                    }), require.register("initialize.js", function(e, t, s) {
                        "use strict";

                        function a(e) {
                            return e && e.__esModule ? e : {
                                "default": e
                            }
                        }

                        function i() {
                            var e = window.game,
                                t = e ? e.config.width : c,
                                s = e ? e.config.height : p,
                                a = document.querySelector("canvas"),
                                i = window.innerWidth,
                                o = window.innerHeight,
                                n = i / o,
                                l = t / s;
                            (a.style.width =  "100%", a.style.height = "100%")
                            a.class = 'game-area';
                        }
                        var o = a(t("./scenes/boot")),
                            n = a(t("./scenes/menu")),
                            l = a(t("./scenes/instructions")),
                            r = a(t("./scenes/game")),
                            u = a(t("./scenes/end")),
                            h = a(t("./scenes/howToPlay")),
                            c = 1009,
                            p = 768;
                        window.onload = function() {
                            window.game = new Phaser.Game({
                                width: c,
                                height: p,
                                type: Phaser.AUTO,
                                title: "Vitaflo's Food Smash Game",
                                url: "https://github.com/samme/brunch-phaser-es6",
                                version: "0.0.1",
                                parent: "food-smash-game-area",
                                input: {
                                    keyboard: !0,
                                    mouse: !0,
                                    touch: !0,
                                    gamepad: !1
                                },
                                banner: {
                                    background: ["#e54661", "#ffa644", "#998a2f", "#2c594f", "#002d40"]
                                },
                                loader: {
                                    path: asset_path + '/asset'
                                },
                                scene: [o["default"], n["default"], l["default"], r["default"], u["default"], h["default"]]
                            }), i(), window.addEventListener("resize", i, !1)
                        }
                    }), require.register("objects/button.js", function(e, t, s) {
                        "use strict";

                        function a(e) {
                            return (a = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                                return typeof e
                            } : function(e) {
                                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                            })(e)
                        }

                        function i(e, t) {
                            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                        }

                        function o(e, t) {
                            for (var s = 0; s < t.length; s++) {
                                var a = t[s];
                                a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
                            }
                        }

                        function n(e, t, s) {
                            return t && o(e.prototype, t), s && o(e, s), e
                        }

                        function l(e, t) {
                            return !t || "object" !== a(t) && "function" != typeof t ? r(e) : t
                        }

                        function r(e) {
                            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                            return e
                        }

                        function u(e) {
                            return (u = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                                return e.__proto__ || Object.getPrototypeOf(e)
                            })(e)
                        }

                        function h(e, t) {
                            if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                            e.prototype = Object.create(t && t.prototype, {
                                constructor: {
                                    value: e,
                                    writable: !0,
                                    configurable: !0
                                }
                            }), t && c(e, t)
                        }

                        function c(e, t) {
                            return (c = Object.setPrototypeOf || function(e, t) {
                                return e.__proto__ = t, e
                            })(e, t)
                        }
                        Object.defineProperty(e, "__esModule", {
                            value: !0
                        }), e["default"] = void 0;
                        var p = function(e) {
                            function t(e, s, a) {
                                var o, n = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : null,
                                    r = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : .6;
                                return i(this, t), o = l(this, u(t).call(this, e, s, a)), o.setPosition(s, a), o.setScale(r), o.setTexture(n), o.callback = null, o.defaultTexture = n, o.hoverTexture = n + "_hover", o.setInteractive(), o.on("pointerover", function() {
                                    o.setTexture(o.hoverTexture)
                                }), o.on("pointerout", function() {
                                    o.setTexture(o.defaultTexture)
                                }), o.on("pointerdown", function() {
                                    o.callback ? o.callback() : console.warn(o.defaultTexture + " button initialised without callback!")
                                }), o
                            }
                            return h(t, e), n(t, [{
                                key: "setCallback",
                                value: function(e) {
                                    this.callback = e
                                }
                            }]), t
                        }(Phaser.GameObjects.Sprite);
                        e["default"] = p
                    }), require.register("objects/fruit.js", function(e, t, s) {
                        "use strict";

                        function a(e) {
                            return (a = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                                return typeof e
                            } : function(e) {
                                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                            })(e)
                        }

                        function i(e, t) {
                            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                        }

                        function o(e, t) {
                            for (var s = 0; s < t.length; s++) {
                                var a = t[s];
                                a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
                            }
                        }

                        function n(e, t, s) {
                            return t && o(e.prototype, t), s && o(e, s), e
                        }

                        function l(e, t) {
                            return !t || "object" !== a(t) && "function" != typeof t ? r(e) : t
                        }

                        function r(e) {
                            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                            return e
                        }

                        function u(e, t, s) {
                            return (u = "undefined" != typeof Reflect && Reflect.get ? Reflect.get : function(e, t, s) {
                                var a = h(e, t);
                                if (a) {
                                    var i = Object.getOwnPropertyDescriptor(a, t);
                                    return i.get ? i.get.call(s) : i.value
                                }
                            })(e, t, s || e)
                        }

                        function h(e, t) {
                            for (; !Object.prototype.hasOwnProperty.call(e, t) && (e = c(e), null !== e););
                            return e
                        }

                        function c(e) {
                            return (c = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                                return e.__proto__ || Object.getPrototypeOf(e)
                            })(e)
                        }

                        function p(e, t) {
                            if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                            e.prototype = Object.create(t && t.prototype, {
                                constructor: {
                                    value: e,
                                    writable: !0,
                                    configurable: !0
                                }
                            }), t && d(e, t)
                        }

                        function d(e, t) {
                            return (d = Object.setPrototypeOf || function(e, t) {
                                return e.__proto__ = t, e
                            })(e, t)
                        }
                        Object.defineProperty(e, "__esModule", {
                            value: !0
                        }), e["default"] = void 0;
                        var g = function(e) {
                            function t(e, s, a) {
                                var o;
                                i(this, t), o = l(this, c(t).call(this, e, s, a)), o.setTexture("fruit"), o.setPosition(s, a), o.setScale(.5), o.setAlpha(0);
                                var n = Math.floor(21 * Math.random()) + 340,
                                    r = Math.random() < .5;
                                return r && (n = 360 - n), o.splat = !1, o.setRotation(n), o
                            }
                            return p(t, e), n(t, [{
                                key: "preUpdate",
                                value: function(e, s) {
                                    u(c(t.prototype), "preUpdate", this).call(this, e, s), this.splat || (this.rotation -= 1e-4 * s)
                                }
                            }, {
                                key: "onSpawn",
                                value: function(e) {
                                    this.setAlpha(1), e || this.setRotation(.6)
                                }
                            }, {
                                key: "onSplat",
                                value: function() {
                                    var e = this,
                                        t = this.texture.key;
                                    this.setTexture(t + "_splat"), this.setScale(.4), this.splat = !0, setTimeout(function() {
                                        e.setAlpha(0)
                                    }, 600)
                                }
                            }]), t
                        }(Phaser.GameObjects.Sprite);
                        e["default"] = g
                    }), require.register("objects/swatter.js", function(e, t, s) {
                        "use strict";

                        function a(e) {
                            return (a = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                                return typeof e
                            } : function(e) {
                                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                            })(e)
                        }

                        function i(e, t) {
                            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                        }

                        function o(e, t) {
                            for (var s = 0; s < t.length; s++) {
                                var a = t[s];
                                a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
                            }
                        }

                        function n(e, t, s) {
                            return t && o(e.prototype, t), s && o(e, s), e
                        }

                        function l(e, t) {
                            return !t || "object" !== a(t) && "function" != typeof t ? r(e) : t
                        }

                        function r(e) {
                            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                            return e
                        }

                        function u(e) {
                            return (u = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                                return e.__proto__ || Object.getPrototypeOf(e)
                            })(e)
                        }

                        function h(e, t) {
                            if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                            e.prototype = Object.create(t && t.prototype, {
                                constructor: {
                                    value: e,
                                    writable: !0,
                                    configurable: !0
                                }
                            }), t && c(e, t)
                        }

                        function c(e, t) {
                            return (c = Object.setPrototypeOf || function(e, t) {
                                return e.__proto__ = t, e
                            })(e, t)
                        }
                        Object.defineProperty(e, "__esModule", {
                            value: !0
                        }), e["default"] = void 0;
                        var p = function(e) {
                            function t(e, s, a) {
                                var o;
                                return i(this, t), o = l(this, u(t).call(this, e, s, a)), o.setTexture("swatter"), o.setOrigin(.5, 1), o.setScale(.6), o.normalPosition = new Phaser.Math.Vector2(s, a + 100), o.swatPosition = new Phaser.Math.Vector2(s, a + 100), o.swattedPosition = new Phaser.Math.Vector2(s, a + 120), o.isSwatting = !1, o.isSwatted = !1, o.allowSwat = !0, o.collisionRect = new Phaser.Geom.Rectangle(0, 0, 150, 150), o.unswat(), o
                            }
                            return h(t, e), n(t, [{
                                key: "swatting",
                                value: function() {
                                    this.isSwatting = !0, this.isSwatted = !1, this.swatPosition.x = this.x, this.normalPosition.x = this.x, this.swattedPosition.x = this.x, this.setTexture("swatter_swat"), this.setPosition(this.swatPosition.x, this.swatPosition.y), this.setScale(.8)
                                }
                            }, {
                                key: "unswat",
                                value: function() {
                                    this.isSwatted = !1, this.setPosition(this.normalPosition.x, this.normalPosition.y), this.setScale(.6)
                                }
                            }, {
                                key: "swatted",
                                value: function() {
                                    this.setTexture("swatter"), this.setPosition(this.swattedPosition.x, this.swattedPosition.y), this.setScale(.8), this.isSwatting = !1, this.isSwatted = !0, this.justSwatted = !0
                                }
                            }, {
                                key: "moveMouse",
                                value: function(e, t) {
                                    var s = window.game.config,
                                        a = Phaser.Math.Clamp(e, s.width / 2 - 200, s.width / 2 + 300);
                                    this.setPosition(a, this.y)
                                }
                            }, {
                                key: "update",
                                value: function(e, t) {
                                    if (this.collisionRect) {
                                        var s = window.game.config;
                                        Phaser.Geom.Rectangle.CenterOn(this.collisionRect, this.x, s.height / 2)
                                    }
                                    if (this.justSwatted && (this.swattedTime = e, this.justSwatted = !1, this.allowSwat = !1), this.isSwatted) {
                                        var a = e - this.swattedTime,
                                            i = Phaser.Math.Clamp(a / 150, 0, 1),
                                            o = Phaser.Math.Linear(this.normalPosition.y, this.swattedPosition.y, i),
                                            n = Phaser.Math.Linear(.8, .6, i);
                                        this.setPosition(this.normalPosition.x, o), this.setScale(n), i >= 1 && (this.isSwatted = !1)
                                    }
                                }
                            }, {
                                key: "swat",
                                value: function(e) {
                                    var t = this;
                                    this.isSwatting || this.isSwatted || this.allowSwat && (this.swatting(), setTimeout(function() {
                                        t.swatted(), setTimeout(function() {
                                            t.unswat(), setTimeout(function() {
                                                t.allowSwat = !0
                                            }, 300), e()
                                        }, 150)
                                    }, 200))
                                }
                            }]), t
                        }(Phaser.GameObjects.Sprite);
                        e["default"] = p
                    }), require.register("scenes/boot.js", function(e, t, s) {
                        "use strict";

                        function a(e) {
                            return e && e.__esModule ? e : {
                                "default": e
                            }
                        }

                        function i(e) {
                            return (i = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                                return typeof e
                            } : function(e) {
                                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                            })(e)
                        }

                        function o(e, t) {
                            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                        }

                        function n(e, t) {
                            for (var s = 0; s < t.length; s++) {
                                var a = t[s];
                                a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
                            }
                        }

                        function l(e, t, s) {
                            return t && n(e.prototype, t), s && n(e, s), e
                        }

                        function r(e, t) {
                            return !t || "object" !== i(t) && "function" != typeof t ? u(e) : t
                        }

                        function u(e) {
                            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                            return e
                        }

                        function h(e) {
                            return (h = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                                return e.__proto__ || Object.getPrototypeOf(e)
                            })(e)
                        }

                        function c(e, t) {
                            if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                            e.prototype = Object.create(t && t.prototype, {
                                constructor: {
                                    value: e,
                                    writable: !0,
                                    configurable: !0
                                }
                            }), t && p(e, t)
                        }

                        function p(e, t) {
                            return (p = Object.setPrototypeOf || function(e, t) {
                                return e.__proto__ = t, e
                            })(e, t)
                        }
                        Object.defineProperty(e, "__esModule", {
                            value: !0
                        }), e["default"] = void 0;
                        var d = a(t("data/const")),
                            g = Phaser.Geom.Rectangle,
                            f = function(e) {
                                function t() {
                                    var e;
                                    return o(this, t), e = r(this, h(t).call(this, "boot")), e.progressBar = null, e.progressBgRect = null, e.progressRect = null, e
                                }
                                return c(t, e), l(t, [{
                                    key: "preload",
                                    value: function() {
                                        this.load.audio("music", "sound/music.wav"),
                                            this.load.image("vitaflo", "menu/vitaflo_logo.png"),
                                            this.load.image("menu-bg", "menu/background.jpg"),
                                            this.load.image("menu-logo", "menu/game_logo.png"),
                                            this.load.image("menu-play", "menu/play_button.png"),
                                            this.load.image("menu-play-hover", "menu/play_button_hover.png"),
                                            this.load.image("menu-play-2", "menu/click_to_play.png"),
                                            this.load.image("menu-play-2-hover", "menu/click_to_play_hover.png"),
                                            this.load.image("menu-instructions", "menu/how_to_play.png"),
                                            this.load.image("menu-top_score", "menu/top_score.png"),
                                            this.load.image("splash-bg", "splash_bg.jpg"),
                                            this.load.image("instructions-panel", "ui/instructions_panel.png"),
                                            this.load.image("game-bg", "game_bg.png"),
                                            this.load.image("game-basket", "game/basket.png"),
                                            this.load.image("swatter", "game/splatter.png"),
                                            this.load.image("swatter_swat", "game/splatter_splat.png"),
                                            this.load.image("banana", "game/banana.png"),
                                            this.load.image("banana_splat", "game/banana_splat.png"),
                                            this.load.image("apple", "game/apple.png"),
                                            this.load.image("apple_splat", "game/apple_splat.png"),
                                            this.load.image("tomato", "game/tomato.png"),
                                            this.load.image("tomato_splat", "game/tomato_splat.png"),
                                            this.load.image("broccoli", "game/broccoli.png"),
                                            this.load.image("broccoli_splat", "game/broccoli_splat.png"),
                                            this.load.image("chocolate", "game/chocolate.png"),
                                            this.load.image("chocolate_splat", "game/chocolate_splat.png"),
                                            this.load.image("marshmallow", "game/marshmallow.png"),
                                            this.load.image("marshmallow_splat", "game/marshmallow_splat.png"),
                                            this.load.image("hard_cheese", "game/hard_cheese.png"),
                                            this.load.image("hard_cheese_splat", "game/hard_cheese_splat.png"),
                                            this.load.image("cream_cheese", "game/cream_cheese.png"),
                                            this.load.image("cream_cheese_splat", "game/cream_cheese_splat.png"),
                                            this.load.image("jelly_sweets", "game/jelly_sweets.png"),
                                            this.load.image("jelly_sweets_splat", "game/jelly_sweets_splat.png"),
                                            this.load.image("hot_chocolate", "game/hot_chocolate.png"),
                                            this.load.image("hot_chocolate_splat", "game/hot_chocolate_splat.png"),
                                            this.load.image("lemonade", "game/lemonade.png"),
                                            this.load.image("lemonade_splat", "game/lemonade_splat.png"),
                                            this.load.image("fast_food", "game/fast_food.png"),
                                            this.load.image("fast_food_splat", "game/fast_food_splat.png"),
                                            this.load.image("home_cooked", "game/home_cooked.png"),
                                            this.load.image("home_cooked_splat", "game/home_cooked_splat.png"),
                                            this.load.image("salt", "game/salt.png"),
                                            this.load.image("salt_splat", "game/salt_splat.png"),
                                            this.load.image("pepper", "game/pepper.png"),
                                            this.load.image("pepper_splat", "game/pepper_splat.png"),
                                            this.load.image("chicken", "game/chicken.png"),
                                            this.load.image("chicken_splat", "game/chicken_splat.png"),
                                            this.load.image("bacon", "game/bacon.png"),
                                            this.load.image("bacon_splat", "game/bacon_splat.png"),
                                            this.load.image("pasta", "game/pasta.png"),
                                            this.load.image("pasta_splat", "game/pasta_splat.png"),
                                            this.load.image("takeaway", "game/takeaway.png"),
                                            this.load.image("takeaway_splat", "game/takeaway_splat.png"),
                                            this.load.image("salty_snacks", "game/salty_snacks.png"),
                                            this.load.image("salty_snacks_splat", "game/salty_snacks_splat.png"),
                                            this.load.image("right_snacks", "game/right_snacks.png"),
                                            this.load.image("right_snacks_splat", "game/right_snacks_splat.png"),
                                            this.load.image("ui-splat_potassium", "ui/ui_splat_potassium.png"),
                                            this.load.image("ui-splat_tomato", "ui/ui_splat_tomato.png"),
                                            this.load.image("ui-splat_chocolate", "ui/ui_splat_chocolate.png"),
                                            this.load.image("ui-splat_hot_chocolate", "ui/ui_splat_hot_chocolate.png"),
                                            this.load.image("ui-splat_fast_food", "ui/ui_splat_fast_food.png"),
                                            this.load.image("ui-splat_salt", "ui/ui_splat_salt.png"),
                                            this.load.image("ui-splat_salty_snacks", "ui/ui_splat_salty_snacks.png"),
                                            this.load.image("ui-splat_count", "ui/ui_splat_count.png"),
                                            this.load.image("ui-splat_good", "ui/ui_splat_good.png"),
                                            this.load.image("ui-splat_oops", "ui/ui_splat_oops.png"),
                                            this.load.image("ui-line", "ui/ui_line.png"),
                                            this.load.image("ui-line2", "ui/ui_line2.png"),
                                            this.load.image("ui-lets_smash", "ui/ui_lets_smash.png"),
                                            this.load.image("ui-lets_smash_hover", "ui/ui_lets_smash_hover.png"),
                                            this.load.image("ui-next_level", "ui/ui_next_level.png"),
                                            this.load.image("ui-next_level_hover", "ui/ui_next_level_hover.png"),
                                            this.load.image("ui-play_again", "ui/ui_play_again.png"),
                                            this.load.image("ui-play_again_hover", "ui/ui_play_again_hover.png"),
                                            this.load.image("ui-start_again", "ui/ui_start_again.png"),
                                            this.load.image("ui-start_again_hover", "ui/ui_start_again_hover.png"),
                                            this.load.image("ui-lets_go", "ui/ui_lets_go.png"),
                                            this.load.image("ui-lets_go_hover", "ui/ui_lets_go_hover.png"),
                                            this.load.image("ui-level_progress", "ui/level_progress.png"),
                                            this.load.image("ui-level_progress-1", "ui/progress_1.png"),
                                            this.load.image("ui-level_progress-2", "ui/progress_2.png"),
                                            this.load.image("ui-level_progress-3", "ui/progress_3.png"),
                                            this.load.image("ui-level_progress-4", "ui/progress_4.png"),
                                            this.load.image("ui-level_progress-5", "ui/progress_5.png"),
                                            this.load.image("ui-level_progress-6", "ui/progress_6.png"),
                                            this.load.image("ui-level_progress-7", "ui/progress_7.png"),
                                            this.load.image("ui-level_progress-8", "ui/progress_8.png"),
                                            this.load.image("ui-level_progress-9", "ui/progress_9.png"),
                                            this.load.image("ui-level_progress-10", "ui/progress_10.png"),
                                            this.load.image("ui-level_progress-11", "ui/progress_11.png"),
                                            this.load.audio("level_success", "sound/level_success.wav"),
                                            this.load.audio("level_fail", "sound/level_fail.wav"),
                                            this.load.audio("splat_success", "sound/splat_success.wav"),
                                            this.load.audio("splat_fail", "sound/splat_fail.wav"),
                                            this.load.audio("game_complete", "sound/game_complete.wav"),
                                            this.load.on("progress", this.onLoadProgress, this),
                                            this.load.on("complete", this.onLoadComplete, this), this.add.text(0, 0, "", {
                                            font: "1px vag_rounded",
                                            fill: 16777215
                                        }), this.add.text(0, 0, "", {
                                            font: "1px trash_hand",
                                            fill: 16777215
                                        }), this.add.text(0, 0, "", {
                                            font: "1px nickelodeon",
                                            fill: 16777215
                                        }), this.createProgressBar()
                                    }
                                }, {
                                    key: "create",
                                    value: function() {
                                        var e = this.sound.add("music");
                                        e.setVolume(.6), e.loop = !0, e.play(), window.game.music = e, this.scene.start("menu")
                                    }
                                }, {
                                    key: "createProgressBar",
                                    value: function() {
                                        var e = this.cameras.main;
                                        this.progressBgRect = new g(0, 0, .5 * e.width, 50), g.CenterOn(this.progressBgRect, .5 * e.width, .5 * e.height), this.progressRect = g.Clone(this.progressBgRect), this.progressBar = this.add.graphics()
                                    }
                                }, {
                                    key: "onLoadComplete",
                                    value: function(e, t, s) {
                                        console.debug("complete", t), console.debug("failed", s), this.progressBar.destroy()
                                    }
                                }, {
                                    key: "onLoadProgress",
                                    value: function(e) {
                                        console.debug("progress", e), this.progressRect.width = e * this.progressBgRect.width, this.progressBar.clear().fillStyle(d["default"].hexColors.darkGray).fillRectShape(this.progressBgRect).fillStyle(this.load.totalFailed ? d["default"].hexColors.red : d["default"].hexColors.white).fillRectShape(this.progressRect)
                                    }
                                }]), t
                            }(Phaser.Scene);
                        e["default"] = f
                    }), require.register("scenes/end.js", function(e, t, s) {
                        "use strict";

                        function a(e) {
                            return e && e.__esModule ? e : {
                                "default": e
                            }
                        }

                        function i(e) {
                            return (i = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                                return typeof e
                            } : function(e) {
                                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                            })(e)
                        }

                        function o(e, t) {
                            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                        }

                        function n(e, t) {
                            for (var s = 0; s < t.length; s++) {
                                var a = t[s];
                                a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
                            }
                        }

                        function l(e, t, s) {
                            return t && n(e.prototype, t), s && n(e, s), e
                        }

                        function r(e, t) {
                            return !t || "object" !== i(t) && "function" != typeof t ? u(e) : t
                        }

                        function u(e) {
                            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                            return e
                        }

                        function h(e) {
                            return (h = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                                return e.__proto__ || Object.getPrototypeOf(e)
                            })(e)
                        }

                        function c(e, t) {
                            if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                            e.prototype = Object.create(t && t.prototype, {
                                constructor: {
                                    value: e,
                                    writable: !0,
                                    configurable: !0
                                }
                            }), t && p(e, t)
                        }

                        function p(e, t) {
                            return (p = Object.setPrototypeOf || function(e, t) {
                                return e.__proto__ = t, e
                            })(e, t)
                        }
                        Object.defineProperty(e, "__esModule", {
                            value: !0
                        }), e["default"] = void 0;
                        var d = (a(t("data/const")), a(t("data/strings")), a(t("objects/button"))),
                            g = function(e) {
                                function t() {
                                    return o(this, t), r(this, h(t).call(this, "end"))
                                }
                                return c(t, e), l(t, [{
                                    key: "init",
                                    value: function(e) {
                                        console.debug("init", this.scene.key, e, this)
                                    }
                                }, {
                                    key: "create",
                                    value: function() {
                                        var e = this,
                                            t = window.game.config,
                                            s = this.sound.add("game_complete");
                                        window.game && window.game.music && window.game.music.setMute(!0), setTimeout(function() {
                                            s.play()
                                        }, 200), setTimeout(function() {
                                            window.game && window.game.music && window.game.music.setMute(!1)
                                        }, 2300);
                                        var a = this.add.image(0, 0, "splash-bg").setOrigin(0);
                                        a.setDisplaySize(t.width, t.height), a.texture.setFilter(Phaser.Textures.FilterMode.LINEAR);
                                        var i = this.add.image(t.width / 2, 20, "instructions-panel");
                                        i.setOrigin(.5, 0), i.setDisplaySize(t.width - 360, t.height);
                                        var o = this.add.image(t.width - 50, 30, "menu-top_score");
                                        o.setOrigin(1, 0), o.setScale(.35);
                                        var n = this.make.text({
                                            x: t.width / 2,
                                            y: 180,
                                            text: "You Have Won!",
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "180px trash_hand",
                                                fill: "white",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1450,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        });
                                        n.setScale(.45);
                                        var l = this.make.text({
                                            x: t.width / 2,
                                            y: 260,
                                            text: "Congratulations",
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "180px trash_hand",
                                                fill: "#E81F76",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1450,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        });
                                        l.setScale(.33);
                                        var r = this.make.text({
                                            x: t.width / 2,
                                            y: 400,
                                            text: "You have managed to smash\nthe foods which need to be\n reduced in the diet. Well done.",
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "104px trash_hand",
                                                fill: "white",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1450,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        });
                                        r.setScale(.43);
                                        var u = this.make.text({
                                            x: t.width / 2,
                                            y: 540,
                                            text: "Please follow the advice provided by your Dietitian regarding which foods and drinks you can have or need to avoid.",
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "72px vag_rounded",
                                                fill: "white",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1400,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        });
                                        u.setScale(.33);
                                        var h = this.add.existing(new d["default"](this, t.width / 2, t.height - 30, "ui-play_again", .58));
                                        h.setOrigin(.5, 1), h.setCallback(function() {
                                            e.start()
                                        });
                                        var c = this.add.image(t.width - 20, t.height - 16, "vitaflo");
                                        c.setOrigin(1, 1), c.setScale(.38), c.texture.setFilter(Phaser.Textures.FilterMode.LINEAR)
                                    }
                                }, {
                                    key: "start",
                                    value: function() {
                                        this.scene.start("game")
                                    }
                                }]), t
                            }(Phaser.Scene);
                        e["default"] = g
                    }), require.register("scenes/game.js", function(e, t, s) {
                        "use strict";

                        function a(e) {
                            return e && e.__esModule ? e : {
                                "default": e
                            }
                        }

                        function i(e) {
                            return (i = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                                return typeof e
                            } : function(e) {
                                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                            })(e)
                        }

                        function o(e, t) {
                            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                        }

                        function n(e, t) {
                            for (var s = 0; s < t.length; s++) {
                                var a = t[s];
                                a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
                            }
                        }

                        function l(e, t, s) {
                            return t && n(e.prototype, t), s && n(e, s), e
                        }

                        function r(e, t) {
                            return !t || "object" !== i(t) && "function" != typeof t ? u(e) : t;
                        }

                        function u(e) {
                            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                            return e
                        }

                        function h(e) {
                            return (h = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                                return e.__proto__ || Object.getPrototypeOf(e)
                            })(e)
                        }

                        function c(e, t) {
                            if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                            e.prototype = Object.create(t && t.prototype, {
                                constructor: {
                                    value: e,
                                    writable: !0,
                                    configurable: !0
                                }
                            }), t && p(e, t)
                        }

                        function p(e, t) {
                            return (p = Object.setPrototypeOf || function(e, t) {
                                return e.__proto__ = t, e
                            })(e, t)
                        }
                        Object.defineProperty(e, "__esModule", {
                            value: !0
                        }), e["default"] = void 0;
                        var d = a(t("lodash")),
                            g = a(t("data/levels")),
                            f = (a(t("data/const")), a(t("objects/fruit"))),
                            _ = a(t("objects/swatter")),
                            m = a(t("objects/button")),
                            y = Phaser.Geom.Rectangle,
                            v = function(e) {
                                function t() {
                                    var e;
                                    return o(this, t), e = r(this, h(t).call(this, "game")), e.currentLevel = 0, e.currentStage = 0, e.loadLevel(e.currentLevel), e.spawnInterval = 1100, e.itemSpeed = 6e3, e.lastSpawnTime = 0, e.spawned = 0, e.swattable = null, e.splats = 0, e.badSplats = 0, e
                                }
                                return c(t, e), l(t, [{
                                    key: "loadLevel",
                                    value: function(e) {
                                        var t = e,
                                            s = this.currentStage;
                                        this.level = this.getLevel(t), this.stage = this.getStage(this.level, s), this.playing = !1, console.log(this.level), this.loadStage(s)
                                    }
                                }, {
                                    key: "loadStage",
                                    value: function(e) {
                                        console.log(this.stage), this.playing = !1
                                    }
                                }, {
                                    key: "getLevel",
                                    value: function(e) {
                                        var t = g["default"].length;
                                        return e > t || e < 0 ? null : g["default"][e]
                                    }
                                }, {
                                    key: "getStage",
                                    value: function(e, t) {
                                        var s = e.levels.length;
                                        return t > s || t < 0 ? null : e.levels[t]
                                    }
                                }, {
                                    key: "createBackground",
                                    value: function() {
                                        this.bg && this.bg.destroy();
                                        var e = window.game.config;
                                        this.bg = this.add.image(-1, -1, "game-bg"), this.bg.setOrigin(0, 0), this.bg.setDisplaySize(e.width + 1, e.height + 1), this.bg.texture.setFilter(Phaser.Textures.FilterMode.LINEAR)
                                    }
                                }, {
                                    key: "createSound",
                                    value: function() {
                                        this.sounds && d["default"].forEach(this.sounds, function(e) {
                                            e.destroy()
                                        });
                                        var e = {};
                                        e.level_success = this.sound.add("level_success"), e.level_fail = this.sound.add("level_fail"), e.splat_success = this.sound.add("splat_success"), e.splat_fail = this.sound.add("splat_fail"), this.sounds = e
                                    }
                                }, {
                                    key: "createStagePopup",
                                    value: function() {
                                        var e = this;
                                        this.stagePopup && d["default"].forEach(this.stagePopup, function(e) {
                                            e.destroy()
                                        });
                                        var t = window.game.config,
                                            s = {},
                                            a = new y(0, 0, t.width, t.height);
                                        s.shade = this.add.graphics({
                                            fillStyle: {
                                                color: 16777215
                                            }
                                        }), s.shade.fillRectShape(a), s.shade.setAlpha(.6), s.shade.setVisible(!1), s.ui_panel = this.add.image(t.width / 2, 20, "instructions-panel"), s.ui_panel.setOrigin(.5, 0), s.ui_panel.setDisplaySize(t.width - 360, t.height), s.ui_panel.setVisible(!1), s.level_text = this.make.text({
                                            x: t.width / 2,
                                            y: t.height / 2 - 100,
                                            text: "Level " + (this.currentLevel + 1),
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "144px trash_hand",
                                                fill: "white",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1450,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        }), s.level_text.setScale(1), s.level_text.setVisible(!1), s.ui_line = this.add.image(t.width / 2, t.height / 2 - 20, "ui-line2"), s.ui_line.setScale(.66), s.ui_line.setVisible(!1), s.stage_text = this.make.text({
                                            x: t.width / 2,
                                            y: t.height / 2 + 45,
                                            text: this.level.title,
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "124px trash_hand",
                                                fill: "white",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1450,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        }), s.stage_text.setScale(.66), s.stage_text.setVisible(!1), s.smash_button = this.add.existing(new m["default"](this, t.width / 2, t.height - 90, "ui-lets_go", .62)), s.smash_button.setCallback(function() {
                                            e.showLevelPopup()
                                        }), s.smash_button.setVisible(!1), this.stagePopup = s
                                    }
                                }, {
                                    key: "createPlayPopup",
                                    value: function() {
                                        var e = this;
                                        this.popup && d["default"].forEach(this.popup, function(e) {
                                            e.destroy()
                                        });
                                        var t = window.game.config,
                                            s = {},
                                            a = new y(0, 0, t.width, t.height);
                                        s.shade = this.add.graphics({
                                            fillStyle: {
                                                color: 16777215
                                            }
                                        }), s.shade.fillRectShape(a), s.shade.setAlpha(.6), s.shade.setVisible(!1);
                                        var i = t.height / 2;
                                        s.basket = this.add.image(-20, i + 90, "game-basket"), s.basket.setScale(.5), s.basket.setAlpha(.7), s.basket.setVisible(!1), s.ui_panel = this.add.image(t.width / 2, 20, "instructions-panel"), s.ui_panel.setOrigin(.5, 0), s.ui_panel.setDisplaySize(t.width - 360, t.height), s.ui_panel.setVisible(!1), s.instructions = this.add.image(t.width - 50, 30, "menu-instructions"), s.instructions.setOrigin(1, 0), s.instructions.setScale(.35), s.instructions.setInteractive().on("pointerdown", function() {
                                            return e.instructions()
                                        }), s.instructions.setVisible(!1);
                                        var o = this.stage.title_offset_x ? this.stage.title_offset_x : 0;
                                        s.stage = this.make.text({
                                            x: t.width / 2 + o,
                                            y: 115,
                                            text: this.stage.title,
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "180px trash_hand",
                                                fill: this.stage.title_colour,
                                                align: "center",
                                                wordWrap: {
                                                    width: 1450,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        }), s.stage.setScale(.33), s.stage.setVisible(!1), s.level_text = this.make.text({
                                            x: t.width / 2,
                                            y: 165,
                                            text: this.level.title + " Level " + this.stage.id,
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "104px trash_hand",
                                                fill: "white",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1450,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        }), s.level_text.setScale(.33), s.level_text.setVisible(!1), s.ui_line = this.add.image(t.width / 2, 195, "ui-line"), s.ui_line.setScale(.56), s.ui_line.setVisible(!1);
                                        var n = this.stage.title_image_offset_x ? this.stage.title_image_offset_x : 0,
                                            l = this.stage.title_image_offset_y ? this.stage.title_image_offset_y : 0;
                                        s.stage_graphic = this.add.image(t.width / 2 + 185 + n, 160 + l, this.stage.bad), s.stage_graphic.setScale(.5), s.stage_graphic.setVisible(!1), s.intro = this.make.text({
                                            x: t.width / 2,
                                            y: t.height / 2 + 30,
                                            text: this.stage.message,
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: this.stage.message_size + " trash_hand",
                                                fill: "white",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1450,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        }), s.intro.setScale(.33), s.intro.setVisible(!1), s.smash_button = this.add.existing(new m["default"](this, t.width / 2, t.height - 90, "ui-lets_smash", .55)), s.smash_button.setCallback(function() {
                                            e.start()
                                        }), s.smash_button.setVisible(!1), this.popup = s
                                    }
                                }, {
                                    key: "createPlaying",
                                    value: function() {
                                        this.playingAssets && d["default"].forEach(this.playingAssets, function(e) {
                                            e.destroy()
                                        });
                                        var e = window.game.config,
                                            t = {};
                                        t.splat_count = this.add.image(-30, -20, "ui-splat_count"), t.splat_count.setVisible(!1), t.splat_count.setScale(.6), t.splat_count.setOrigin(0, 0), t.level_splat = this.add.image(25, 35, this.stage.ui_splat_texture), t.level_splat.setVisible(!1), t.level_splat.setScale(.61), t.level_splat.setOrigin(0, 0), t.level_splat.setPosition(this.stage.ui_splat_x, 35), t.splats = this.make.text({
                                            x: 70 - this.stage.count_offset,
                                            y: 75,
                                            text: this.stage.goal,
                                            style: {
                                                font: "124px nickelodeon",
                                                fill: this.stage.goal_colour ? this.stage.goal_colour : "white",
                                                align: "center"
                                            }
                                        }), t.splats.setVisible(!1), t.splats.setScale(.45), t.splatText = this.make.text({
                                            x: this.stage.splat_x,
                                            y: this.stage.splat_y,
                                            text: this.stage.splat,
                                            style: {
                                                font: this.stage.splat_size + " trash_hand",
                                                fill: "white",
                                                align: "center"
                                            }
                                        }), t.splatText.setVisible(!1), t.splatText.setScale(.5), t.good_splat = this.add.image(e.width / 2 + 80, e.height / 2 + 80, "ui-splat_good"), t.good_splat.setVisible(!1), t.good_splat.setScale(.6), t.good_splat.setOrigin(0, 0), t.bad_splat = this.add.image(e.width + 100, e.height, "ui-splat_oops"), t.bad_splat.setVisible(!1), t.bad_splat.setScale(.4), t.bad_splat.setOrigin(1, 1), t.bad_splatText = this.make.text({
                                            x: e.width + this.stage.oops_x,
                                            y: e.height + this.stage.oops_y,
                                            text: this.stage.oops,
                                            style: {
                                                font: "80px trash_hand",
                                                fill: "white",
                                                align: "center"
                                            }
                                        }), t.bad_splatText.setVisible(!1), t.bad_splatText.setScale(.4), t.basket = this.add.image(40, e.height / 2 - 20, "game-basket"), t.basket.setVisible(!1), t.basket.setOrigin(.5, 0), t.basket.setScale(.6), t.basket.setDepth(6), t.level_progress = this.add.image(e.width + 50, -50, "ui-level_progress"), t.level_progress.setVisible(!1), t.level_progress.setOrigin(1, 0), t.level_progress.setScale(.6);
                                        var s = t.level_progress.displayOriginX - 98;
                                        t.level_progress_meter = this.add.image(s, 43, this.stage.level_progress), t.level_progress_meter.setVisible(!1), t.level_progress_meter.setOrigin(0, 0), t.level_progress_meter.setScale(.6), this.playingAssets = t
                                    }
                                }, {
                                    key: "createBasket",
                                    value: function() {
                                        this.basket && d["default"].forEach(this.basket, function(e) {
                                            e.destroy()
                                        }), this.basket = [];
                                        var e = this.playingAssets.basket,
                                            t = e.x - 20,
                                            s = e.y - e.displayOriginY + 100,
                                            a = e.width / 3 - 70,
                                            i = e.height * e.scaleY - 150,
                                            o = new Phaser.Geom.Rectangle(t, s, a, i);
                                        this.basketRect = o;
                                        for (var n = 0, l = 0; l < this.stage.total; l++) {
                                            l % 6 == 0 && n++;
                                            var r = o.getRandomPoint(),
                                                u = o.bottom + 40,
                                                h = parseInt(u) - 45 * n,
                                                c = new f["default"](this, r.x, h);
                                            c.setScale(.4), c.setTexture(this.stage.good), this.add.existing(c), this.basket.push(c)
                                        }
                                    }
                                }, {
                                    key: "createEndLevel",
                                    value: function() {
                                        var e = this;
                                        this.endLevel && d["default"].forEach(this.endLevel, function(e) {
                                            e.destroy()
                                        });
                                        var t = window.game.config,
                                            s = {},
                                            a = new y(0, 0, t.width, t.height);
                                        s.shade = this.add.graphics({
                                            fillStyle: {
                                                color: 16777215
                                            }
                                        }), s.shade.fillRectShape(a), s.shade.setAlpha(.6), s.shade.setVisible(!1), s.ui_panel = this.add.image(t.width / 2 + 130, 20, "instructions-panel"), s.ui_panel.setOrigin(.5, 0), s.ui_panel.setDisplaySize(t.width - 360, t.height), s.ui_panel.setVisible(!1), s.stage = this.make.text({
                                            x: t.width / 2 + 130,
                                            y: 120,
                                            text: "Game Over",
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "180px trash_hand",
                                                fill: "#ffde16",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1450,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        }), s.stage.setScale(.33), s.stage.setVisible(!1), s.ui_line = this.add.image(t.width / 2 + 130, 165, "ui-line"), s.ui_line.setScale(.56), s.ui_line.setVisible(!1), s.splat = this.add.image(t.width / 2 + 20, 260, this.stage.ui_splat_texture), s.splat.setScale(this.stage.end_splat_scale), s.splat.setVisible(!1), s.ui_line2 = this.add.image(t.width / 2 + 10, 260, "ui-line"), s.ui_line2.setScale(.22), s.ui_line2.setRotation(-45), s.ui_line2.setVisible(!1), s.splats = this.make.text({
                                            x: t.width / 2 - 20 - this.stage.count_offset,
                                            y: 230,
                                            text: this.splats,
                                            style: {
                                                font: "132px nickelodeon",
                                                fill: this.stage.goal_colour ? this.stage.goal_colour : "white",
                                                align: "center"
                                            }
                                        }), s.splats.setScale(.35), s.splats.setVisible(!1), s.totalSplats = this.make.text({
                                            x: t.width / 2 + 15,
                                            y: 250,
                                            text: this.stage.goal,
                                            style: {
                                                font: "132px nickelodeon",
                                                fill: this.stage.goal_colour ? this.stage.goal_colour : "white",
                                                align: "center"
                                            }
                                        }), s.totalSplats.setScale(.3), s.totalSplats.setVisible(!1), s.smashText = this.make.text({
                                            x: t.width / 2 + 210,
                                            y: 260,
                                            text: "Smashes",
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "180px trash_hand",
                                                fill: "white",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1450,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        }), s.smashText.setScale(.35), s.smashText.setVisible(!1), s.splatText = this.make.text({
                                            x: t.width / 2 + 125,
                                            y: t.height / 2 + 100,
                                            text: "Your basket has no " + this.stage.splat + " in it.\nWell done!",
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "180px trash_hand",
                                                fill: "white",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1350,
                                                    useAdvancedWrap: !1
                                                }
                                            }
                                        }), s.splatText.setScale(.3), s.splatText.setVisible(!1), s.play_again = this.add.existing(new m["default"](this, t.width / 2 - 160, 180, "ui-play_again", .58)), s.play_again.setOrigin(1, 1), s.play_again.setCallback(function() {
                                            e.restart()
                                        }), s.play_again.setVisible(!1), s.next_level = this.add.existing(new m["default"](this, t.width / 2 + 125, t.height - 20, "ui-next_level", .65)), s.next_level.setOrigin(.5, 1), s.next_level.setCallback(function() {
                                            e.nextLevel()
                                        }), s.next_level.setVisible(!1), s.start_again = this.add.existing(new m["default"](this, t.width / 2 + 125, t.height - 20, "ui-start_again", .65)), s.start_again.setOrigin(.5, 1), s.start_again.setCallback(function() {
                                            e.restart()
                                        }), s.start_again.setVisible(!1), this.endLevel = s
                                    }
                                }, {
                                    key: "renderEndLevel",
                                    value: function() {
                                        var e = this;
                                        d["default"].forEach(this.endLevel, function(e) {
                                            e.setVisible(!0)
                                        });
                                        var t = this.stage.goal_colour;
                                        this.endLevel.splats.style.setColor(t), this.endLevel.totalSplats.style.setColor(t);
                                        var s = t.replace(/^#/, "0x");
                                        this.endLevel.ui_line2.setTint(s), this.endLevel.ui_line2.tintFill = !0;
                                        var a = this.splats < this.stage.goal || this.badSplats > 0;
                                        a ? (window.game && window.game.music && window.game.music.setMute(!0), setTimeout(function() {
                                            e.sounds.level_fail.play()
                                        }, 200), setTimeout(function() {
                                            window.game && window.game.music && window.game.music.setMute(!1)
                                        }, 1700), this.endLevel.stage.setText("Game Over"), this.endLevel.stage.style.setColor("#007F6E"), this.endLevel.splats.setText(this.splats), this.badSplats > 0 ? this.endLevel.splatText.setText(this.stage.too_many_good) : this.endLevel.splatText.setText("There are too many \n".concat(this.stage.splat, " in your basket!")), this.endLevel.play_again.setVisible(!1), this.endLevel.start_again.setVisible(!0), this.endLevel.next_level.setVisible(!1)) : (window.game && window.game.music && window.game.music.setMute(!0), setTimeout(function() {
                                            e.sounds.level_success.play()
                                        }, 200), setTimeout(function() {
                                            window.game && window.game.music && window.game.music.setMute(!1)
                                        }, 3e3), this.endLevel.stage.setText("Congratulations"), this.endLevel.stage.style.setColor("#E81F76"), this.endLevel.splats.setText(this.splats), this.endLevel.splatText.setText("Your Basket Has\n No ".concat(this.stage.splat, " in it. Well Done!")), this.endLevel.play_again.setVisible(!0), this.endLevel.start_again.setVisible(!1), this.endLevel.next_level.setVisible(!0))
                                    }
                                }, {
                                    key: "showStagePopup",
                                    value: function() {
                                        0 == this.currentStage ? (d["default"].forEach(this.stagePopup, function(e) {
                                            e.setVisible(!0)
                                        }), d["default"].forEach(this.popup, function(e) {
                                            e.setVisible(!1)
                                        })) : this.showLevelPopup()
                                    }
                                }, {
                                    key: "showLevelPopup",
                                    value: function() {
                                        d["default"].forEach(this.stagePopup, function(e) {
                                            e.setVisible(!1)
                                        }), d["default"].forEach(this.popup, function(e) {
                                            e.setVisible(!0)
                                        })
                                    }
                                }, {
                                    key: "create",
                                    value: function() {
                                        this.createBackground(), this.createPlayPopup(), this.createStagePopup(), this.createSound(), this.showStagePopup(), this.graphics = this.add.graphics(), this.createPlaying(), this.createBasket(), this.createEndLevel(), this.spawnInterval = this.stage.spawn_interval, this.itemSpeed = this.stage.item_speed
                                    }
                                }, {
                                    key: "spawnItem",
                                    value: function(e, t) {
                                        if (this.spawned < this.stage.total) {
                                            var s = Math.floor(3 * Math.random()),
                                                a = {
                                                    index: this.spawned,
                                                    t: 1,
                                                    vec: new Phaser.Math.Vector2,
                                                    sprite: this.items[this.spawned],
                                                    splat: !1,
                                                    texture: this.items[this.spawned].texture,
                                                    path: s
                                                };
                                            a.sprite.onSpawn(this.stage.random_rotation);
                                            var i = this.spawnedItems.push(a);
                                            this.tweens.add({
                                                targets: this.spawnedItems[i - 1],
                                                t: 0,
                                                duration: this.itemSpeed,
                                                yoyo: !1,
                                                repeat: 0
                                            }), this.lastSpawnTime = e, this.spawned++
                                        }
                                    }
                                }, {
                                    key: "removeItem",
                                    value: function(e) {
                                        var t = this.basket[e.index];
                                        t && !e.splat && (t.setTexture(e.texture.key), t.setVisible(!0), t.setAlpha(1), t.setActive(!1)), e.sprite.setAlpha(0), e.removed = !0
                                    }
                                }, {
                                    key: "update",
                                    value: function(e, t) {
                                        var s = this;
                                        window.game.config;
                                        if (this.playing) {
                                            this.playingAssets.splats.setText(this.stage.goal - this.splats);
                                            var a = (this.stage.goal - this.splats).toString();
                                            if (1 == a.length && this.playingAssets.splats.setPosition(70, this.playingAssets.splats.y), e - this.lastSpawnTime > this.spawnInterval && this.spawnItem(e, t), d["default"].each(this.spawnedItems, function(e) {
                                                    var t = s.paths[e.path].getPoint(e.t, e.vec);
                                                    e.splat || e.sprite.setPosition(t.x, t.y), e.t <= 0 && !e.removed && s.removeItem(e)
                                                }), this.swatter.update(e, t), this.splats >= this.stage.goal && this.stop(e, t), this.spawned == this.stage.total) {
                                                var i = d["default"].filter(this.spawnedItems, function(e) {
                                                    return 0 == e.t
                                                });
                                                i.length == this.spawnedItems.length && this.stop(e, t)
                                            }
                                        }
                                        this.paths && this.paths.length > 0 && (this.graphics.clear(), this.graphics.lineStyle(2, 16777215, 1)), this.swatter && this.swatter.collisionRect
                                    }
                                }, {
                                    key: "instructions",
                                    value: function() {
                                        this.scene.start("howToPlay")
                                    }
                                }, {
                                    key: "onSwat",
                                    value: function() {
                                        var e = this.getSwattable();
                                        if (null != e) {
                                            var t = d["default"].find(this.spawnedItems, e);
                                            0 == t.splat && (t.splat = !0, t.sprite.onSplat(), t.sprite.texture.key == this.stage.bad + "_splat" ? this.onGoodSwat() : this.onBadSwat())
                                        }
                                    }
                                }, {
                                    key: "onGoodSwat",
                                    value: function() {
                                        var e = this;
                                        this.splats++, this.playingAssets.good_splat.setVisible(1), this.playingAssets.good_splat.x = this.swatter.x + 50, this.sounds.splat_success.play(), setTimeout(function() {
                                            e.playingAssets.good_splat.setVisible(0)
                                        }, 2e3)
                                    }
                                }, {
                                    key: "onBadSwat",
                                    value: function() {
                                        var e = this;
                                        this.badSplats++, this.playingAssets.bad_splat.setVisible(1), this.playingAssets.bad_splatText.setVisible(1), this.sounds.splat_fail.play(), setTimeout(function() {
                                            e.playingAssets.bad_splat.setVisible(0), e.playingAssets.bad_splatText.setVisible(0)
                                        }, 2e3)
                                    }
                                }, {
                                    key: "getSwattable",
                                    value: function() {
                                        var e = this,
                                            t = null;
                                        return d["default"].each(this.spawnedItems, function(s) {
                                            if (!s.splat) {
                                                var a = s.sprite.width / 2,
                                                    i = s.sprite.height,
                                                    o = s.vec.x,
                                                    n = s.vec.y,
                                                    l = new Phaser.Geom.Rectangle(o - a / 2, n - i / 2, a, i);
                                                Phaser.Geom.Intersects.RectangleToRectangle(e.swatter.collisionRect, l) && (t = s)
                                            }
                                        }), t
                                    }
                                }, {
                                    key: "start",
                                    value: function() {
                                        var e = this;
                                        d["default"].forEach(this.popup, function(e) {
                                            e.setVisible(!1)
                                        }), d["default"].forEach(this.stagePopup, function(e) {
                                            e.setVisible(!1)
                                        }), d["default"].forEach(this.playingAssets, function(e) {
                                            e.setVisible(!0)
                                        }), this.playingAssets.good_splat.setVisible(!1), this.playingAssets.bad_splat.setVisible(!1), this.playingAssets.bad_splatText.setVisible(!1);
                                        var t = new f["default"](this, 0, 0);
                                        t.setTexture(this.stage.good);
                                        var s = new f["default"](this, 0, 0);
                                        s.setTexture(this.stage.bad);
                                        var a = window.game.config;
                                        this.paths = [];
                                        var i = new Phaser.Curves.Path(50, 500);
                                        i.cubicBezierTo(a.width, a.height / 2 - 125, 150, 450, 300, 300), this.paths.push(i), i = new Phaser.Curves.Path(50, 500), i.cubicBezierTo(a.width, a.height / 2, 150, 450, 300, 300), this.paths.push(i), i = new Phaser.Curves.Path(50, 500), i.cubicBezierTo(a.width, a.height / 2 + 125, 150, 450, 300, 300), this.paths.push(i), this.bg.setInteractive().on("pointerdown", function() {
                                            e.swatter.swat(e.onSwat.bind(e))
                                        }), d["default"].each(this.items, function(e) {
                                            e.destroy()
                                        }), d["default"].each(this.spawnedItems, function(e) {
                                            e.sprite.destroy()
                                        }), this.items = [], this.spawnedItems = [];
                                        for (var o = 0; o < this.stage.total; o++)
                                            if (o < this.stage.goal) {
                                                var n = new f["default"](this, 0, 0);
                                                n.setTexture(this.stage.bad), this.items.push(n)
                                            } else {
                                                var l = new f["default"](this, 0, 0);
                                                l.setTexture(this.stage.good), this.items.push(l)
                                            } this.items = d["default"].shuffle(d["default"].shuffle(this.items)), this.playing = !0, d["default"].each(this.items, function(t) {
                                            e.add.existing(t, 0, 0)
                                        }), this.swatter && this.swatter.destroy(), this.swatter = new _["default"](this, a.width / 2, a.height), this.add.existing(this.swatter), this.input.on("pointermove", function(t) {
                                            e.swatter.moveMouse(t.x, t.y)
                                        }), d["default"].forEach(this.endLevel, function(e) {
                                            e.setVisible(!1)
                                        })
                                    }
                                }, {
                                    key: "stop",
                                    value: function(e, t) {
                                        this.playing = !1, this.renderEndLevel(), d["default"].forEach(this.playingAssets, function(e) {
                                            e.setVisible(!1)
                                        }), d["default"].forEach(this.spawnedItems, function(e) {
                                            e.sprite.setVisible(!1)
                                        }), this.swatter.setVisible(!1), this.playingAssets.basket.setVisible(!0)
                                    }
                                }, {
                                    key: "restart",
                                    value: function() {
                                        this.resetStage(), this.start()
                                    }
                                }, {
                                    key: "resetStage",
                                    value: function() {
                                        this.loadLevel(this.currentLevel), this.lastSpawnTime = 0, this.spawned = 0, this.swattable = null, this.splats = 0, this.badSplats = 0, this.spawnInterval = this.stage.spawn_interval, this.itemSpeed = this.stage.item_speed, this.swatter && this.swatter.destroy(), this.graphics && this.graphics.destroy(), this.graphics = this.add.graphics(), this.createBackground(), this.createPlayPopup(), this.createStagePopup(), this.createBasket(), this.createPlaying(), this.createEndLevel(), this.showStagePopup()
                                    }
                                }, {
                                    key: "reset",
                                    value: function() {
                                        this.playing = !1, this.currentLevel = 0, this.currentStage = 0, this.resetStage()
                                    }
                                }, {
                                    key: "onNextLevel",
                                    value: function() {
                                        this.playing = !1, this.resetStage()
                                    }
                                }, {
                                    key: "nextLevel",
                                    value: function s() {
                                        this.currentStage++;
                                        var e = this.getStage(this.level, this.currentStage);
                                        if (e) this.stage = e, this.onNextLevel();
                                        else {
                                            this.currentLevel++;
                                            var s = this.getLevel(this.currentLevel);
                                            s ? (this.level = s, this.currentStage = 0, this.stage = this.getStage(this.level, 0), this.onNextLevel()) : (this.reset(), this.scene.start("end"))
                                        }
                                    }
                                }]), t
                            }(Phaser.Scene);
                        e["default"] = v
                    }), require.register("scenes/howToPlay.js", function(e, t, s) {
                        "use strict";

                        function a(e) {
                            return e && e.__esModule ? e : {
                                "default": e
                            }
                        }

                        function i(e) {
                            return (i = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                                return typeof e
                            } : function(e) {
                                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                            })(e)
                        }

                        function o(e, t) {
                            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                        }

                        function n(e, t) {
                            for (var s = 0; s < t.length; s++) {
                                var a = t[s];
                                a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
                            }
                        }

                        function l(e, t, s) {
                            return t && n(e.prototype, t), s && n(e, s), e
                        }

                        function r(e, t) {
                            return !t || "object" !== i(t) && "function" != typeof t ? u(e) : t
                        }

                        function u(e) {
                            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                            return e
                        }

                        function h(e) {
                            return (h = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                                return e.__proto__ || Object.getPrototypeOf(e)
                            })(e)
                        }

                        function c(e, t) {
                            if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                            e.prototype = Object.create(t && t.prototype, {
                                constructor: {
                                    value: e,
                                    writable: !0,
                                    configurable: !0
                                }
                            }), t && p(e, t)
                        }

                        function p(e, t) {
                            return (p = Object.setPrototypeOf || function(e, t) {
                                return e.__proto__ = t, e
                            })(e, t)
                        }
                        Object.defineProperty(e, "__esModule", {
                            value: !0
                        }), e["default"] = void 0;
                        var d = (a(t("data/const")), a(t("data/strings"))),
                            g = function(e) {
                                function t() {
                                    return o(this, t), r(this, h(t).call(this, "howToPlay"))
                                }
                                return c(t, e), l(t, [{
                                    key: "init",
                                    value: function(e) {
                                        console.debug("init", this.scene.key, e, this)
                                    }
                                }, {
                                    key: "create",
                                    value: function() {
                                        var e = this,
                                            t = window.game.config,
                                            s = this.add.image(0, 0, "splash-bg").setOrigin(0);
                                        s.setDisplaySize(t.width, t.height), s.texture.setFilter(Phaser.Textures.FilterMode.LINEAR);
                                        var a = this.add.image(t.width / 2, 20, "instructions-panel");
                                        a.setOrigin(.5, 0), a.setDisplaySize(t.width - 360, t.height);
                                        var i = this.make.text({
                                            x: t.width / 2,
                                            y: 150,
                                            text: "How To Play",
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "116px trash_hand",
                                                fill: "white",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1450,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        });
                                        i.setScale(.8);
                                        var o = this.make.text({
                                            x: t.width / 2,
                                            y: t.height / 2 - 40,
                                            text: d["default"].how_to_play,
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "112px vag_rounded",
                                                fill: "white",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1400,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        });
                                        o.setScale(.33);
                                        var n = this.make.text({
                                            x: t.width / 2,
                                            y: t.height - 230,
                                            text: "Good Luck",
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "116px trash_hand",
                                                fill: "white",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1450,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        });
                                        n.setScale(.8);
                                        var l = this.add.image(t.width / 2, t.height - 40, "menu-play-2");
                                        l.setOrigin(.5, 1), l.setScale(.36), l.setInteractive().on("pointerdown", function() {
                                            return e.start()
                                        }), l.on("pointerover", function() {
                                            l.setTexture("menu-play-2-hover")
                                        }), l.on("pointerout", function() {
                                            l.setTexture("menu-play-2")
                                        })
                                    }
                                }, {
                                    key: "start",
                                    value: function() {
                                        this.scene.start("game")
                                    }
                                }]), t
                            }(Phaser.Scene);
                        e["default"] = g
                    }), require.register("scenes/instructions.js", function(e, t, s) {
                        "use strict";

                        function a(e) {
                            return e && e.__esModule ? e : {
                                "default": e
                            }
                        }

                        function i(e) {
                            return (i = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                                return typeof e
                            } : function(e) {
                                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                            })(e)
                        }

                        function o(e, t) {
                            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                        }

                        function n(e, t) {
                            for (var s = 0; s < t.length; s++) {
                                var a = t[s];
                                a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
                            }
                        }

                        function l(e, t, s) {
                            return t && n(e.prototype, t), s && n(e, s), e
                        }

                        function r(e, t) {
                            return !t || "object" !== i(t) && "function" != typeof t ? u(e) : t
                        }

                        function u(e) {
                            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                            return e
                        }

                        function h(e) {
                            return (h = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                                return e.__proto__ || Object.getPrototypeOf(e)
                            })(e)
                        }

                        function c(e, t) {
                            if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                            e.prototype = Object.create(t && t.prototype, {
                                constructor: {
                                    value: e,
                                    writable: !0,
                                    configurable: !0
                                }
                            }), t && p(e, t)
                        }

                        function p(e, t) {
                            return (p = Object.setPrototypeOf || function(e, t) {
                                return e.__proto__ = t, e
                            })(e, t)
                        }
                        Object.defineProperty(e, "__esModule", {
                            value: !0
                        }), e["default"] = void 0;
                        var d = (a(t("data/const")), a(t("data/strings"))),
                            g = function(e) {
                                function t() {
                                    return o(this, t), r(this, h(t).call(this, "instructions"))
                                }
                                return c(t, e), l(t, [{
                                    key: "init",
                                    value: function(e) {
                                        console.debug("init", this.scene.key, e, this)
                                    }
                                }, {
                                    key: "create",
                                    value: function() {
                                        var e = this,
                                            t = window.game.config,
                                            s = this.add.image(0, 0, "splash-bg").setOrigin(0);
                                        s.setDisplaySize(t.width, t.height), s.texture.setFilter(Phaser.Textures.FilterMode.LINEAR);
                                        var a = this.add.image(t.width / 2, 20, "instructions-panel");
                                        a.setOrigin(.5, 0), a.setDisplaySize(t.width - 360, t.height);
                                        var i = this.make.text({
                                            x: t.width / 2,
                                            y: t.height / 2,
                                            text: d["default"].instructions,
                                            origin: {
                                                x: .5,
                                                y: .5
                                            },
                                            style: {
                                                font: "76px vag_rounded",
                                                fill: "white",
                                                align: "center",
                                                wordWrap: {
                                                    width: 1300,
                                                    useAdvancedWrap: !0
                                                }
                                            }
                                        });
                                        i.setScale(.33);
                                        var o = this.add.image(t.width / 2, t.height - 40, "menu-play-2");
                                        o.setOrigin(.5, 1), o.setScale(.36), o.setInteractive().on("pointerdown", function() {
                                            return e.start()
                                        }), o.on("pointerover", function() {
                                            o.setTexture("menu-play-2-hover")
                                        }), o.on("pointerout", function() {
                                            o.setTexture("menu-play-2")
                                        })
                                    }
                                }, {
                                    key: "start",
                                    value: function() {
                                        this.scene.start("game")
                                    }
                                }]), t
                            }(Phaser.Scene);
                        e["default"] = g
                    }), require.register("scenes/menu.js", function(e, t, s) {
                        "use strict";

                        function a(e) {
                            return e && e.__esModule ? e : {
                                "default": e
                            }
                        }

                        function i(e) {
                            return (i = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                                return typeof e
                            } : function(e) {
                                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                            })(e)
                        }

                        function o(e, t) {
                            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                        }

                        function n(e, t) {
                            for (var s = 0; s < t.length; s++) {
                                var a = t[s];
                                a.enumerable = a.enumerable || !1, a.configurable = !0, "value" in a && (a.writable = !0), Object.defineProperty(e, a.key, a)
                            }
                        }

                        function l(e, t, s) {
                            return t && n(e.prototype, t), s && n(e, s), e
                        }

                        function r(e, t) {
                            return !t || "object" !== i(t) && "function" != typeof t ? u(e) : t
                        }

                        function u(e) {
                            if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                            return e
                        }

                        function h(e) {
                            return (h = Object.setPrototypeOf ? Object.getPrototypeOf : function(e) {
                                return e.__proto__ || Object.getPrototypeOf(e)
                            })(e)
                        }

                        function c(e, t) {
                            if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
                            e.prototype = Object.create(t && t.prototype, {
                                constructor: {
                                    value: e,
                                    writable: !0,
                                    configurable: !0
                                }
                            }), t && p(e, t)
                        }

                        function p(e, t) {
                            return (p = Object.setPrototypeOf || function(e, t) {
                                return e.__proto__ = t, e
                            })(e, t)
                        }
                        Object.defineProperty(e, "__esModule", {
                            value: !0
                        }), e["default"] = void 0;
                        var d = (a(t("data/const")), function(e) {
                            function t() {
                                return o(this, t), r(this, h(t).call(this, "menu"))
                            }
                            return c(t, e), l(t, [{
                                key: "init",
                                value: function(e) {
                                    console.debug("init", this.scene.key, e, this)
                                }
                            }, {
                                key: "create",
                                value: function() {
                                    var e = this,
                                        t = this.add.image(0, 0, "menu-bg").setOrigin(0),
                                        s = window.game.config;
                                    t.setDisplaySize(s.width, s.height), t.texture.setFilter(Phaser.Textures.FilterMode.LINEAR);
                                    var a = this.add.image(s.width / 2, s.height - 102, "menu-play");
                                    a.setOrigin(.5, 1), a.setScale(.36), a.setInteractive().on("pointerdown", function() {
                                        return e.start()
                                    }), a.on("pointerover", function() {
                                        a.setTexture("menu-play-hover")
                                    }), a.on("pointerout", function() {
                                        a.setTexture("menu-play")
                                    });
                                    var i = this.add.image(s.width / 2, s.height / 2 - 30, "menu-logo");
                                    i.setScale(.36, .4), i.texture.setFilter(Phaser.Textures.FilterMode.LINEAR);
                                    var o = this.add.image(s.width - 20, s.height - 16, "vitaflo");
                                    o.setOrigin(1, 1), o.setScale(.38), o.texture.setFilter(Phaser.Textures.FilterMode.LINEAR);
                                    var n = this.add.image(s.width - 50, 30, "menu-instructions");
                                    n.setOrigin(1, 0), n.setScale(.35), n.setInteractive().on("pointerdown", function() {
                                        return e.instructions()
                                    })
                                }
                            }, {
                                key: "start",
                                value: function() {
                                    this.scene.start("instructions")
                                }
                            }, {
                                key: "instructions",
                                value: function() {
                                    this.scene.start("howToPlay")
                                }
                            }]), t
                        }(Phaser.Scene));
                        e["default"] = d
                    }), require.alias("buffer/index.js", "buffer"), require.alias("process/browser.js", "process"), e = require("process"), require.register("___globals___", function(e, t, s) {})
                }(), require("___globals___"), require("initialize");
        }
    };

})(jQuery, Drupal, drupalSettings);