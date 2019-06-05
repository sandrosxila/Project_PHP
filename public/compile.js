var scripts = new Map([
    ['C++', '#include <iostream>\n' +
    '\n' +
    'using namespace std;\n' +
    '\n' +
    'int main() {\n' +
    '\tint x=10;\n' +
    '\tint y=25;\n' +
    '\tint z=x+y;\n' +
    '\n' +
    '\tcout<<"Sum of x+y = " << z;\n' +
    '}\n'],

    ['NodeJS', 'var x = 10;\n' +
    'var y = 25;\n' +
    'var z = x + y;\n' +
    '\n' +
    'console.log("x + y = " + z);\n'],

    ['Python 3', 'x=10;\n' +
    'y=25;\n' +
    'z=x+y;\n' +
    'print ("sum of x+y =", z);\n'],

    ['Java', 'public class MyClass {\n' +
    '    public static void main(String args[]) {\n' +
    '        int x=10;\n' +
    '        int y=25;\n' +
    '        int z=x+y;\n' +
    '\n' +
    '        System.out.println("Sum of x+y = " + z);\n' +
    '    }\n' +
    '}\n'],

    ['PHP', '<?php\n' +
    '\n' +
    '    $x=10;\n' +
    '    $y=25;\n' +
    '    $z=$x+$y;\n' +
    '\n' +
    '    $msg = \'Sum of x+y = \';\n' +
    '\n' +
    '    print($msg.$z);\n' +
    '\n' +
    '?>'],
]);

var editor = ace.edit("editor");
var PythonMode = ace.require("ace/mode/python").Mode;
var JavaScriptMode = ace.require("ace/mode/javascript").Mode;
var JavaMode = ace.require("ace/mode/java").Mode;
var CppMode = ace.require("ace/mode/c_cpp").Mode;
var PhpMode = ace.require("ace/mode/php").Mode;

$(function() {
    $('#choose_lang').val( $('#opt').val() );
    $('#checker').val( "0" );
    var txt = $('#choose_lang option:selected').text();
    if(txt=='C++'){
        editor.session.setMode(new CppMode());
    }
    else if(txt=='NodeJS'){
        editor.session.setMode(new JavaScriptMode());
    }
    else if(txt=='Python 3'){
        editor.session.setMode(new PythonMode());
    }
    else if(txt=='Java'){
        editor.session.setMode(new JavaMode());
    }
    else if(txt=='PHP'){
        editor.session.setMode(new PhpMode());
    }
    $('#saveButton').hide();
    $('#subname').hide();
});

function convert(str)
{
    str = str.replace(/&/g, "&amp;");
    str = str.replace(/>/g, "&gt;");
    str = str.replace(/</g, "&lt;");
    str = str.replace(/"/g, "&quot;");
    str = str.replace(/'/g, "&#039;");
    return str;
}

$('#choose_lang  option').click(function() {
    var txt = $('#choose_lang option:selected').text();
//    console.log(txt,scripts.get(txt));
    $('#checker').val( "1" );
    $('#lang').val($('#choose_lang option:selected').val());
    if(editor.getValue()=='') {
        editor.setValue("");
        editor.session.insert(editor.getCursorPosition(), scripts.get(txt));
    }
    if(txt=='C++'){

        editor.session.setMode(new CppMode());
    }
    else if(txt=='NodeJS'){
        editor.session.setMode(new JavaScriptMode());
    }
    else if(txt=='Python 3'){
        editor.session.setMode(new PythonMode());
    }
    else if(txt=='Java'){
        editor.session.setMode(new JavaMode());
    }
    else if(txt=='PHP'){
        editor.session.setMode(new PhpMode());
    }
});
$('#compilebutton').click(function() {
    $('#code').val(convert(editor.getValue()));
    $('#stdin').val(convert($('#stdin').val()));
});
$('#saveAsButton').click(function () {
    $('#saveButton').slideToggle();
    $('#subname').slideToggle();
    $("#saveAsButton").hide();
});
$('#saveButton').click(function () {
    $('#saveButton').slideToggle();
    $('#subname').slideToggle();
    $("#saveAsButton").show();
});
function slideUp(index) {
    $('#collapse'+index).slideToggle();
}
function insertInput(index){
    $('#heading'+index).append("<input type=\"hidden\" name=\"codeId\" value=\""+$('#code'+index).val()+"\">");
    $('#heading'+index).append("<input type=\"hidden\" name=\"Script\" value=\""+convert($('#pre'+index).text())+"\">");
    $('#heading'+index).append("<input type=\"hidden\" name=\"Language\" value=\""+convert($('#lang'+index).val())+"\">");
}
$('#updateButton').click(function () {
    $('#needUpdate').val("1");
});