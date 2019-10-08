$('form').submit(function(e){
    e.preventDefault();
});



function handle() {
    var url = $('#url');
    var name = $('#fname');
    var release = $('#release');
    var cat = $('#cat');
    var lang = $('#lang');
    if(!validate(url, 'Remote Link')){
        return;
    }
    if(!validate(name, 'Name')){
        return;
    }
    if(!validate(release, 'Release Year')){
        return;
    }
    if(!validate(cat, 'Category')){
        return;
    }
    if(!validate(lang, 'Language')){
        return;
    }
}

function validate(sel, arg) {
    if (sel.val() == '') {
        alert(''+arg+' Cannot be empty!');
        return false;
    }
    return true;
}
