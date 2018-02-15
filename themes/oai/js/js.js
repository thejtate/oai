(function ($) {

  if (typeof Drupal != 'undefined') {
    Drupal.behaviors.projectName = {
      attach: function (context, settings) {
        init();
      },

      completedCallback: function () {
        // Do nothing. But it's here in case other modules/themes want to override it.
      }
    }
  }

  $(function () {
    if (typeof Drupal == 'undefined') {
      init();
    }
  });

  $(window).load(function () {
    initTextBlocks();
    initPartnersImg();
    initScrollSelect();
  });

  function init() {
    initSelect();
    initFlexslider();
    initPopup();
    initVideoPlay();
    initNavColumns();
    initMobileNav();
    scrollTo($('.btn-to-top a'), 400, 0);
    initScrollToTop();
    initHeaderSearch();
    initModalShow();
    initElmsAnimation();
    collapsedBlock();

  }

  function  initScrollToTop(){
    var $btn = $('.btn-to-top.style-a a');

    if(!$btn.length) return;

    $(window).bind('scroll', function(){
      var goalElem = $($btn.attr('href')).offset().top;

      if($(window).scrollTop() >= goalElem){
        $btn.parent().addClass('active');
      }else{
        $btn.parent().removeClass('active');
      }
    })
  }

  function initScrollSelect() {
    var $formTimeLine = $('.form-timeline select');

    if(!$formTimeLine.length) return;

    var $body = $('body, html');
    var prefix = 'history-';
    var prefixContent = 'item-';
    var speed = 600;

    if(window.location.hash && ~window.location.hash.indexOf('#' + prefix)) {
      animation(window.location.hash.replace('#' + prefix, ''));
    }

    $formTimeLine.on('change', function () {
      animation($(this).val());
    });

    function animation(val) {
      var $target = $('#' + prefixContent + val);

      if(!$target.length) return;

      window.location.hash = prefix + val;

      $body.animate({scrollTop: $target.offset().top - 10}, speed);
    }
  }

  function initSelect() {
    $('select').select2({
      width: 'full',
      minimumResultsForSearch: Infinity
    });
  }

  function collapsedBlock() {
    var $elms = $('.collapsed-block');

    if(!$elms.length) return;

    $elms.each(function() {
      var $this = $(this);
      var $btn = $this.find('.collapsed-btn');

      $btn.on('click', function(e) {
        e.preventDefault();

        $this.toggleClass('collapsed')
      });
    });
  }

  function initElmsAnimation() {
    var $elms = $('.el-with-animation');
    var animationEnd = [];

    $(window).on('resize scroll', checkScroll);

    checkScroll();

    function checkScroll() {
      if (animationEnd.length === $elms.length) return;

      for (var i = 0; i < $elms.length; i++) {
        var $currentEl = $elms.eq(i);
        if (!$currentEl.hasClass('animating-end') && $(window).height() + $(window).scrollTop() > $currentEl.offset().top + $currentEl.height() / 2 + 50) {
          animate($currentEl);
        }
      }
    }

    function animate(el) {
      el.addClass('animating-end');
      animationEnd.push(1);
    }
  }

  function initFlexslider() {
    $('.flexslider').flexslider({
      animation: "fade",
      directionNav: true,
      controlNav: false
    });
  }

  function initPopup() {
    checkHash(window.location.hash);

    $(window).on('hashchange', function() {
      checkHash(window.location.hash);
    });

    $('.modal').on('hide.bs.modal', function () {
      window.location.hash = '';
    });

    function checkHash(hash) {
      if(!hash) return;

      var $el = $(hash);

      if($el.hasClass('b-modal')) {
        $el.modal('show');
      }
    }
  }

  function initModalShow() {
    $('.modal').on('show.bs.modal', function () {
      var $this = $(this);

      if(!$this.hasClass('image')) return;

      var img = $this[0].querySelector('img');
      var naturalWidth = img.naturalWidth;
      var naturalHeight = img.naturalHeight;
      var wW, wH;


      $(window).on('resize', function() {
        wW = $(window).outerWidth();
        wH = $(window).outerHeight();

        if(naturalWidth > wW || naturalHeight > wH) {
          thumb(img, wW - 40, wH - 40);
        } else {
          img.width = naturalWidth;
          img.height = naturalHeight;
        }

      }).resize();

    });

    function thumb(img, width, height) {
      var x_ratio = width / img.width;
      var y_ratio = height / img.height;

      var ratio = Math.min(x_ratio, y_ratio);
      var use_x_ratio = x_ratio < y_ratio ? 1 : 0;

      var w = use_x_ratio ? width : Math.ceil(img.width * ratio);
      var h = !use_x_ratio ? height : Math.ceil(img.height * ratio);

      img.width = w;
      img.height = h;
    }
  }

  function initPartnersImg() {
    var $footer = $('#site-footer .middle-footer');

    if(!$footer.length) return;

    $footer.find('li').each(function() {
      var $this = $(this).find('img');

      $this.width($this.width()/2);
      $this.addClass('processed');
    });
  }

  function initHeaderSearch() {
    var $wrapper = $('.site-header .search'),
      $btn = $wrapper.find('.top-search-button');

    $btn.on('click touch', function (e) {
      e.preventDefault();

      $wrapper.find('.form-text').get(0).focus();
      $wrapper.toggleClass('active');
    })
  }

  function scrollTo(el, speed, correction) {
    if (!el.length || !$(el.attr('href')).length) return;

    el.on('click touch', function (e) {
      e.preventDefault();

      $('html, body').animate({
        scrollTop: $(this.getAttribute('href')).offset().top + correction + 'px'
      }, speed);
    });
  }

  function initTextBlocks() {
    var $wrapper = $('.text-blocks-wrapper');

    if (!$wrapper.length) return;

    $(window).on('resize', function () {
      $wrapper.each(function () {
        var $this = $(this);

        setHeight($this);
      });
    }).resize();

    function setHeight(el) {
      var $elms = el.find('.text-block');
      var height = 0;
      var $currentEl;
      var currentHeight;

      for (var i = 0; i < $elms.length; i++) {
        $currentEl = $elms.eq(i);

        $currentEl.height('auto');
        $currentEl.find('.text-block-inner-set-height').height('auto');
        currentHeight = $currentEl.height();

        if (height < currentHeight) {
          height = currentHeight;
        }
      }

      $elms.height(height);

      for (var i = 0; i < $elms.length; i++) {
        $currentEl = $elms.eq(i);

        var $elmsInner = $currentEl.find('.text-block-inner');

        if (!$elmsInner.length) continue;

        var $elmsInnerWithH = $elmsInner.filter('.text-block-inner-set-height');
        var $elmsInnerWithoutH = $elmsInner.filter(':not(.text-block-inner-set-height)');

        currentHeight = 0;

        for (var y = 0; y < $elmsInnerWithoutH.length; y++) {
          currentHeight += $elmsInnerWithoutH.eq(y).height();
        }

        $elmsInnerWithH.height((height - currentHeight) / $elmsInnerWithH.length);
      }

      $elms.addClass('loaded');
    }
  }

  function initNavColumns() {
    var $header = $('#site-header');
    var $body = $('body');
    var $cols = $header.find('.col');

    if ($body.hasClass('site-header-cols-processed')) return;

    $body.addClass('site-header-cols-processed');

    var $currentList;
    var newUl = '';
    for (var i = 0; i < $cols.length; i++) {
      $currentList = $cols.eq(i).find('> ul li');
      newUl = '';

      for (var y = 3; y < $currentList.length; y++) {
        if (y % 3 == 0) {
          newUl += '</ul><ul>';
        }

        $currentList.eq(y).remove();
        newUl += '<li>' + $currentList.eq(y).html() + '</li>';

        if (y == $currentList.length - 1) {
          newUl += '</ul>';
          newUl = newUl.replace('</ul>', '')
        }
      }

      $currentList.parent().parent().append(newUl);
    }
  }

  function initVideoPlay() {
    var $btn = $('.btn-play');

    if (!$btn.length) return;

    var currentVideo, url;

    $btn.on('click touch', function (e) {
      e.preventDefault();

      var href = this.getAttribute('href').replace('#', '');
      currentVideo = document.getElementById(href);

      if(currentVideo.tagName == 'VIDEO') {
        videoControl(currentVideo);
      } else if(currentVideo) {
        currentVideo.setAttribute('src', currentVideo.getAttribute('src') + '&autoplay=1');
      }
    });

    $('.modal').on('hide.bs.modal', function () {
      if (currentVideo) {
        if(currentVideo.tagName == 'VIDEO') {
          videoControl(currentVideo);
        } else {
          url = currentVideo.getAttribute('src').replace('&autoplay=1', '');
          currentVideo.setAttribute('src', url);

          $(currentVideo).after($(currentVideo).clone());
         $(currentVideo).remove();
        }

        currentVideo = false;
      }
    });

    function videoControl(video) {
      if (video.paused) {
        video.play();
      } else {
        video.pause();
      }
    }
  }

  function initMobileNav() {
    var $wrapper = $('.nav');
    var $listWrapper = $wrapper.find('.menu-block-wrapper ul');
    var $list = $listWrapper.find('li');
    var $listLinks = $list.find('a');
    var $btn = $('.nav .btn-mobile');
    var $body = $('body');

    if ($wrapper.hasClass('nav-processed')) return;

    $wrapper.addClass('nav-processed');

    for (var i = 0; i < $listLinks.length; i++) {
      var $current = $listLinks.eq(i);

      if (!$current.siblings('.sublevel').length) continue;

      $current.siblings('.sublevel').find('.col:first-child ul').eq(0).prepend('<li class="back-nav-btn"><a href="#">back</a></li>');
      $current.append('<span class="icon-next-menu"></span>');
    }

    var $btnNextMenu = $wrapper.find('.icon-next-menu');
    var $btnBack = $wrapper.find('.back-nav-btn a');

    $btnNextMenu.on('click touch', function (e) {
      e.preventDefault();

      var $this = $(this).parents('li');

      if ($this.hasClass('active-next-level')) {
        $this.removeClass('active-next-level');
        $body.removeClass('second-nav-level-active');
        return;
      }

      $list.removeClass('active-next-level');
      $this.toggleClass('active-next-level');
      $body.toggleClass('second-nav-level-active');
    });

    $btnBack.on('click touch', function (e) {
      e.preventDefault();

      var $this = $(this).parents('.active-next-level');

      setTimeout(function () {
        $this.removeClass('active-next-level');
      }, 300);

      $body.removeClass('second-nav-level-active');
    });

    $btn.on('click touch', function (e) {
      e.preventDefault();

      $body.toggleClass('mobile-nav-active');
    });

    $body.on('click touch', function (e) {
      if (!$(e.target).closest($wrapper).length) {
        if ($body.hasClass('mobile-nav-active')) $body.removeClass('mobile-nav-active');
      }
    });
  }

})(jQuery);