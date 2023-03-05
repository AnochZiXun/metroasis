var _validFileExtensions = [".jpg", ".jpeg"];    
function validateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert(sFileName + "檔案格式不正確。\n符合的格式：" + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}

function validateMultipleInput(oInput) {
    if (oInput.type == "file") {
        var invalidFileName = "";
        for(var i = 0 ; i < oInput.files.length ; i ++){
            var sFileName = oInput.files[i]["name"];
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
            if(!blnValid) invalidFileName += sFileName + "\n";
        }
        if (invalidFileName != "") {
                alert(invalidFileName + "檔案格式不正確。\n符合的格式：" + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
        }

    }
    return true;
}