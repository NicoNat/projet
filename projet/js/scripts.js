// TODO (1) Ajoutez la class 'used' aux input quand l'evenement blur se declanche et que leur valeur n'est pas vide
/* TODO (2) Au click du bouton Login, un message en haut du form (pas une boite de dialog) s'affiche,
  il indique "Pseudo ou Mot de passe incorrect!" si le pseudo n'est pas "jon" et le mot de passe n'est pas "snow"
  sinon il indique "Pseudo et Mot de passe correct!".
  Utilisez les classes "correct" et "incorrect" pour donner la bonne couleur au message
*/
// TODO (3) Assurez vous que le message n'apparet qu'une seule fois, meme si on click plusieurs fois.

$(window).ready(function() {
  $('input').blur(function() {
    let input = $(this);
    if (input.val())
      input.addClass('used');
    else
      input.removeClass('used');
  });

  $("button.login").click(function() {
    let pseudo = $("#pseudo").val();
    let mdp = $("#motdepasse").val();

    let message = $("#message");

    if(pseudo != "jon" || mdp != "snow") {
      if(message.length == 0) { // Il n'existe pas d'element message
        message = $("<div id=\"message\" class=\"incorrect\">Pseudo ou Mot de passe incorrect!</div>");
        $("#header").after(message);
      } else { // message existe
        message.html("Pseudo ou Mot de passe incorrect!");
        message.removeClass("correct");
        message.addClass("incorrect");
      }
    } else {
      if(message.length == 0) { // Il n'existe pas d'element message
        message = $("<div id=\"message\" class=\"correct\">Pseudo et Mot de passe correct!</div>");
        $("#header").after(message);
      } else { // message existe
        message.html("Pseudo et Mot de passe correct!");
        message.removeClass("incorrect");
        message.addClass("correct");
      }

      //window.location.href='iutodo.html';
    }
  });
});
