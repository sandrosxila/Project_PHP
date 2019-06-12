    <form action="" method="post" enctype="multipart/form-data">
        <p class="text-primary row" style="margin-bottom: -17px;">Select Language</p><br>
        <div class="row">

            <select id="choose_lang" required style="width:120px;">
                <option value="cpp14">C++</option>
                <option value="nodejs">NodeJS</option>
                <option value="python3">Python 3</option>
                <option value="java">Java</option>
                <option value="php">PHP</option>
            </select>
            <input type="hidden" id="code" name="Script">
            <input type="hidden" id="checker" name="Check" value="{{Check}}">
            <input type="hidden" id="lang" name="Language" value="{{Language}}">
            <input type="hidden" id="opt" value="{{Opt}}">
        </div>
        <div class="row">
            <div  class="col-6">
                <div id="editor" class="col" style="margin-left: -15px;">{{script}}</div>
            </div>
            <div class="col-1"></div>
            <div id='inout' class="col-5">
                <p>input...</p>
                <div class="row">

                    <textarea id="stdin" class="col" name="Input">{{input}}</textarea>
                </div>
                <div class="row d-flex justify-content-center">

                    <button type="submit" id="compilebutton" class="btn btn-primary mr-5">compile</button>
                        {{ButtonUpload}}
                        {{Buttons}}
                </div>
                <div >
                    <p >output...</p>
                </div>
                <div class="row">
                    <textarea id="stdout" class="col" readonly>{{output}}</textarea>
                </div>
            </div>
        </div>
    </form>

