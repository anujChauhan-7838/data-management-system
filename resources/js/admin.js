/*! AdminLTE app.js
 * ================
 * Main JS application file for AdminLTE v2. This file
 * should be included in all pages. It controls some layout
 * options and implements exclusive AdminLTE plugins.
 *
 * @Author  Almsaeed Studio
 * @Support <https://www.almsaeedstudio.com>
 * @Email   <abdullah@almsaeedstudio.com>
 * @version 2.4.5
 * @repository git://github.com/almasaeed2010/AdminLTE.git
 * @license MIT <http://opensource.org/licenses/MIT>
 */
if ("undefined" == typeof jQuery) throw new Error("requires jQuery"); + function(a) {
    "use strict";   
}(jQuery),  
function(a) {
    "use strict";

    function b(b) {
        return this.each(function() {
            var e = a(this),
                f = e.data(c);
            if (!f) {
                var h = a.extend({}, d, e.data(), "object" == typeof b && b);
                e.data(c, f = new g(h))
            }
            if ("string" == typeof b) {
                if (void 0 === f[b]) throw new Error("No method named " + b);
                f[b]()
            }
        })
    }
    var c = "lte.layout",
        d = {
            slimscroll: !0,
            resetHeight: !0
        },
        e = {
            wrapper: ".wrapper",
            contentWrapper: ".content-wrapper",
            layoutBoxed: ".layout-boxed",
            mainFooter: ".main-footer",
            mainHeader: ".main-header",
            sidebar: ".sidebar",
            controlSidebar: ".control-sidebar",
            fixed: ".fixed",
            sidebarMenu: ".sidebar-menu",
            logo: ".main-header .logo"
        },
        f = {
            fixed: "fixed",
            holdTransition: "hold-transition"
        },
        g = function(a) {
            this.options = a, this.bindedResize = !1, this.activate()
        };
    g.prototype.activate = function() {
        this.fix(), this.fixSidebar(), a("body").removeClass(f.holdTransition), this.options.resetHeight && a("body, html, " + e.wrapper).css({
            height: "auto",
            "min-height": "100%"
        }), this.bindedResize || (a(window).resize(function() {
            this.fix(), this.fixSidebar(), a(e.logo + ", " + e.sidebar).one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function() {
                this.fix(), this.fixSidebar()
            }.bind(this))
        }.bind(this)), this.bindedResize = !0), a(e.sidebarMenu).on("expanded.tree", function() {
            this.fix(), this.fixSidebar()
        }.bind(this)), a(e.sidebarMenu).on("collapsed.tree", function() {
            this.fix(), this.fixSidebar()
        }.bind(this))
    }, g.prototype.fix = function() {
        a(e.layoutBoxed + " > " + e.wrapper).css("overflow", "hidden");
        var b = a(e.mainFooter).outerHeight() || 0,
            c = a(e.mainHeader).outerHeight() || 0,
            d = c + b,
            g = a(window).height(),
            h = a(e.sidebar).height() || 0;
        if (a("body").hasClass(f.fixed)) a(e.contentWrapper).css("min-height", g - b);
        else {
            var i;
            g >= h ? (a(e.contentWrapper).css("min-height", g - d), i = g - d) : (a(e.contentWrapper).css("min-height", h), i = h);
            var j = a(e.controlSidebar);
            void 0 !== j && j.height() > i && a(e.contentWrapper).css("min-height", j.height())
        }
    }, g.prototype.fixSidebar = function() {
        if (!a("body").hasClass(f.fixed)) return void(void 0 !== a.fn.slimScroll && a(e.sidebar).slimScroll({
            destroy: !0
        }).height("auto"));
        this.options.slimscroll && void 0 !== a.fn.slimScroll && a(e.sidebar).slimScroll({
            height: a(window).height() - a(e.mainHeader).height() + "px"
        })
    };
    var h = a.fn.layout;
    a.fn.layout = b, a.fn.layout.Constuctor = g, a.fn.layout.noConflict = function() {
        return a.fn.layout = h, this
    }, a(window).on("load", function() {
        b.call(a("body"))
    })
}(jQuery),
function(a) {
    "use strict";

    function b(b) {
        return this.each(function() {
            var e = a(this),
                f = e.data(c);
            if (!f) {
                var g = a.extend({}, d, e.data(), "object" == typeof b && b);
                e.data(c, f = new h(g))
            }
            "toggle" === b && f.toggle()
        })
    }
    var c = "lte.pushmenu",
        d = {
            collapseScreenSize: 767,
            expandOnHover: !1,
            expandTransitionDelay: 200
        },
        e = {
            collapsed: ".sidebar-collapse",
            open: ".sidebar-open",
            mainSidebar: ".main-sidebar",
            contentWrapper: ".content-wrapper",
            searchInput: ".sidebar-form .form-control",
            button: '[data-toggle="push-menu"]',
            mini: ".sidebar-mini",
            expanded: ".sidebar-expanded-on-hover",
            layoutFixed: ".fixed"
        },
        f = {
            collapsed: "sidebar-collapse",
            open: "sidebar-open",
            mini: "sidebar-mini",
            expanded: "sidebar-expanded-on-hover",
            expandFeature: "sidebar-mini-expand-feature",
            layoutFixed: "fixed"
        },
        g = {
            expanded: "expanded.pushMenu",
            collapsed: "collapsed.pushMenu"
        },
        h = function(a) {
            this.options = a, this.init()
        };
    h.prototype.init = function() {
        (this.options.expandOnHover || a("body").is(e.mini + e.layoutFixed)) && (this.expandOnHover(), a("body").addClass(f.expandFeature)), a(e.contentWrapper).click(function() {
            a(window).width() <= this.options.collapseScreenSize && a("body").hasClass(f.open) && this.close()
        }.bind(this)), a(e.searchInput).click(function(a) {
            a.stopPropagation()
        })
    }, h.prototype.toggle = function() {
        var b = a(window).width(),
            c = !a("body").hasClass(f.collapsed);
        b <= this.options.collapseScreenSize && (c = a("body").hasClass(f.open)), c ? this.close() : this.open()
    }, h.prototype.open = function() {
        a(window).width() > this.options.collapseScreenSize ? a("body").removeClass(f.collapsed).trigger(a.Event(g.expanded)) : a("body").addClass(f.open).trigger(a.Event(g.expanded))
    }, h.prototype.close = function() {
        a(window).width() > this.options.collapseScreenSize ? a("body").addClass(f.collapsed).trigger(a.Event(g.collapsed)) : a("body").removeClass(f.open + " " + f.collapsed).trigger(a.Event(g.collapsed))
    }, h.prototype.expandOnHover = function() {
        a(e.mainSidebar).hover(function() {
            a("body").is(e.mini + e.collapsed) && a(window).width() > this.options.collapseScreenSize && this.expand()
        }.bind(this), function() {
            a("body").is(e.expanded) && this.collapse()
        }.bind(this))
    }, h.prototype.expand = function() {
        setTimeout(function() {
            a("body").removeClass(f.collapsed).addClass(f.expanded)
        }, this.options.expandTransitionDelay)
    }, h.prototype.collapse = function() {
        setTimeout(function() {
            a("body").removeClass(f.expanded).addClass(f.collapsed)
        }, this.options.expandTransitionDelay)
    };
    var i = a.fn.pushMenu;
    a.fn.pushMenu = b, a.fn.pushMenu.Constructor = h, a.fn.pushMenu.noConflict = function() {
        return a.fn.pushMenu = i, this
    }, a(document).on("click", e.button, function(c) {
        c.preventDefault(), b.call(a(this), "toggle")
    }), a(window).on("load", function() {
        b.call(a(e.button))
    })
}(jQuery);

$(document).ready(function () {
    //Initialize tooltips
   // $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
    });
    $(".prev-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);
    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}



+function ($) {
  'use strict';

  var DataKey = 'lte.tree'; 
  var Default = {
    animationSpeed: 500,
    accordion     : true,
    followLink    : true,
    trigger       : '.treeview a'
  }; 
  var Selector = {
    tree        : '.tree',
    treeview    : '.treeview',
    treeviewMenu: '.treeview-menu',
    open        : '.menu-open, .active',
    li          : 'li',
    data        : '[data-widget="tree"]',
    active      : '.active'
  };

  var ClassName = {
    open: 'menu-open',
    tree: 'tree'
  };

  var Event = {
    collapsed: 'collapsed.tree',
    expanded : 'expanded.tree'
  };

  // Tree Class Definition
  // =====================
  var Tree = function (element, options) {
    this.element = element;
    this.options = options;

    $(this.element).addClass(ClassName.tree);

    $(Selector.treeview + Selector.active, this.element).addClass(ClassName.open);

    this._setUpListeners();
  };

  Tree.prototype.toggle = function (link, event) {
    var treeviewMenu = link.next(Selector.treeviewMenu);
    var parentLi     = link.parent();
    var isOpen       = parentLi.hasClass(ClassName.open);

    if (!parentLi.is(Selector.treeview)) {
      return;
    }

    if (!this.options.followLink || link.attr('href') === '#') {
      event.preventDefault();
    }

    if (isOpen) {
      this.collapse(treeviewMenu, parentLi);
    } else {
      this.expand(treeviewMenu, parentLi);
    }
  };

  Tree.prototype.expand = function (tree, parent) {
    var expandedEvent = $.Event(Event.expanded);

    if (this.options.accordion) {
      var openMenuLi = parent.siblings(Selector.open);
      var openTree   = openMenuLi.children(Selector.treeviewMenu);
      this.collapse(openTree, openMenuLi);
    }

    parent.addClass(ClassName.open);
    tree.slideDown(this.options.animationSpeed, function () {
      $(this.element).trigger(expandedEvent);
    }.bind(this));
  };

  Tree.prototype.collapse = function (tree, parentLi) {
    var collapsedEvent = $.Event(Event.collapsed);

    //tree.find(Selector.open).removeClass(ClassName.open);
    parentLi.removeClass(ClassName.open);
    tree.slideUp(this.options.animationSpeed, function () {
      //tree.find(Selector.open + ' > ' + Selector.treeview).slideUp();
      $(this.element).trigger(collapsedEvent);
    }.bind(this));
  };

  // Private

  Tree.prototype._setUpListeners = function () {
    var that = this;

    $(this.element).on('click', this.options.trigger, function (event) {
      that.toggle($(this), event);
    });
  };

  // Plugin Definition
  // =================
  function Plugin(option) {
    return this.each(function () {
      var $this = $(this);
      var data  = $this.data(DataKey);

      if (!data) {
        var options = $.extend({}, Default, $this.data(), typeof option == 'object' && option);
        $this.data(DataKey, new Tree($this, options));
      }
    });
  }

  var old = $.fn.tree;

  $.fn.tree             = Plugin;
  $.fn.tree.Constructor = Tree;

  // No Conflict Mode
  // ================
  $.fn.tree.noConflict = function () {
    $.fn.tree = old;
    return this;
  };

  // Tree Data API
  // =============
  $(window).on('load', function () {
    $(Selector.data).each(function () {
      Plugin.call($(this));
    });
  });

}(jQuery);

  
// var lines = $('.table-rwd tr th').map(function(){
//     return $(this).text()
// })
//  $('.table-rwd tr').each(function(index, v) {
//      $(this).find("td").each(function(i){
//          $(this).prepend('<span>'+lines[i]+':</span>')
//      })
// });
 
    $('table.table-rwd').each(function () {        
        var trAcc = $(this).find('tr').not('tr:first-child'),
            thHead = [];
    
        $(this).find('tr:first-child td, tr:first-child th').each(function () {
            headLines = $(this).text();
            thHead.push(headLines);
        });
    
        trAcc.each(function () {
            for (i = 0, l = thHead.length; i < l; i++) {
                $(this).find('td').eq(i + 1).prepend('<h3>' + thHead[i + 1] + '</h3>');
            }
        });
    
        trAcc.append('<i class="icon-accordion">+</i>');
        trAcc.click(function () {
           
            
            if ($(this).hasClass('accordion-opened')) {
                $(this).animate({
                    maxHeight: '50px'
                },1000).removeClass('accordion-opened').find('.icon-accordion').text('+');
    
            }  else {

                // $('table tr').animate({
                //     maxHeight: '50px'
                // }, 200).removeClass('accordion-opened').find('.icon-accordion').text('+');

                $(this).animate({
                    maxHeight: '1000px'
                }, 1000).addClass('accordion-opened').find('.icon-accordion').text('-');
                
            }
        });
    });
 
 


 
