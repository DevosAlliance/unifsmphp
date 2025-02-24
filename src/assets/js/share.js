document.addEventListener("DOMContentLoaded", function() {
    var url = encodeURIComponent(window.location.href);
    var titulo = encodeURIComponent(document.title);
    var conteudo = encodeURIComponent(document.title + " " + window.location.href);

    // WhatsApp
    document.getElementById("whatsapp-share-btt").href = "https://api.whatsapp.com/send?text=" + conteudo;

    // Twitter
    document.getElementById("twitter-share-btt").href = "https://twitter.com/intent/tweet?url="+url+"&text="+titulo;

    // Facebook
    document.getElementById("facebook-share-btt").href = "https://www.facebook.com/sharer/sharer.php?u=" + url;

    // LinkedIn
    var linkedinLink = "https://www.linkedin.com/shareArticle?mini=true&url="+url+"&title="+titulo;
    
    var summary = document.querySelector("meta[name='description']")?.getAttribute("content") || 
                  document.querySelector("meta[property='og:description']")?.getAttribute("content");
    
    if(summary) {
        linkedinLink += "&summary=" + encodeURIComponent(summary);
    }
    
    document.getElementById("linkedin-share-btt").href = linkedinLink;
});
