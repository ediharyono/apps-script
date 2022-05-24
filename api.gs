function doGet(request) {
    var output = ContentService.createTextOutput();
    var data = {};
    //https://docs.google.com/spreadsheets/d/1Hw-_bzNE4MDY3LsK4R_XCdG9fL7PFg5o1Ff7GsGGUHg/edit#gid=0
    var id = '1Hw-_bzNE4MDY3LsK4R_XCdG9fL7PFg5o1Ff7GsGGUHg';
    var sheet = 'aktivitas_mahasiswa';
    var cell = '';
    var ss = SpreadsheetApp.openById(id);
    if (sheet) {
      if (cell) {
        data = ss.getSheetByName(sheet).getRange(cell).getValue();
      } else {
        data = readData_(ss, sheet);
      }
    } else {
      ss.getSheets().forEach(function(oSheet, iIndex) {
        var sName = oSheet.getName();
        if (! sName.match(/^_/)) {
          data = readData_(ss, sName);
        }
      })
    }
  var result = cell ? data :JSON.stringify({status:'Success', data:data});
    var callback = request.parameters.callback;
    if (callback == undefined) {
      output.setContent(result);
      output.setMimeType(cell ? ContentService.MimeType.TEXT : ContentService.MimeType.JSON);
    }
    else {
      output.setContent(callback + "(" + result + ")");
      output.setMimeType(ContentService.MimeType.JAVASCRIPT);
    }
    return output;
  }
  
  
  function readData_(ss, sheetname, properties) {
  
    if (typeof properties == "undefined") {
      properties = getHeaderRow_(ss, sheetname);
      properties = properties.map(function(p) { return p.replace(/\s+/g, '_'); });
    }
    
    var rows = getDataRows_(ss, sheetname);
    var data = [];
    for (var r = 0, l = rows.length; r < l; r++) {
      var row = rows[r];
      var record = {};
      for (var p in properties) {
        record[properties[p]] = row[p];
      }
      data.push(record);
    }
    return data;
  }
  
  function getDataRows_(ss, sheetname) {
    var sh = ss.getSheetByName(sheetname);
    return sh.getRange(2, 1, sh.getLastRow() - 1, sh.getLastColumn()).getValues();
  
  }
  
  
  function getHeaderRow_(ss, sheetname) {
    var sh = ss.getSheetByName(sheetname);
    return sh.getRange(1, 1, 1, sh.getLastColumn()).getValues()[0];

  }
