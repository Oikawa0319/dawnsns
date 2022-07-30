

$(function () {
  // menu_triggerをクリックしたら実行される
  $(".menu_trigger").click(function () {
    // menu_triggerをクリックしたらactiveをclassを追加、削除する / 解説：.toggleClass("クラス名")は、指定したクラス名がなければ追加し、あれば削除するというメソッドです。メニューを１回クリックしたときにクラス名を付けて、もう一度クリックしたときに削除することができます
    $(this).toggleClass("active");
    // menu_boxのclassをblock要素にする/解説：cssメソッドでjsでも変更が出来る
    $('.menu_box').css('display', 'block');
    // activeのclassがあるか判定する/解説：hasClassは指定したclassがあるか判定する
    if ($(this).hasClass("active")) {
      // menu_boxのclassにactiveのclassを追加する/解説：指定した要素にclassを追加する
      $(".menu_box").addClass("active");
      // 一致しない場合の処理
    } else {
      // menu_boxのclassのactiveのclassを削除する/解説：指定した要素からclassを削除する
      $(".menu_box").removeClass("active");
      // menu_boxのclassを非表示にする / 解説：cssメソッドでjsでも変更が出来る
      $('.menu_box').css('display', 'none');
    }
    // 関数を止める/解説：親要素へのイベント伝播を止める
    return false;
  });
});


$(function () {
  // update_btnを繰返し処理する
  $('.update_btn').each(function () {
    // update_btnをクリックしたら実行する
    $(this).on('click', function () {//onを付ける時が分からない
      // クリックしたdata-targetのidの値を取得してtarget変数に代入する/解説：dataは引数の値を取得する
      var target = $(this).data('target');
      // tatget変数の要素を取得する/解説：getElementByIdは複数の要素を取得出来ない為、target変数を繰返し処理で取得する
      var modal = document.getElementById(target);
      // modal変数をフェードインで表示する
      $(modal).fadeIn();
      // 関数を止める/解説：親要素へのイベント伝播を止める
      return false;
    });
  });
  // modalCloseをクリックしたら実行される
  $('.modalClose').on('click', function () {
    // js-modalのclassをフェードアウトする
    $('.js-modal').fadeOut();
    // 関数を止める/解説：親要素へのイベント伝播を止める
    return false;
  });
});
