//https://www.bpwebs.com/pull-data-from-google-sheets-to-html-table/

function doGet(e) {
  var page = e.parameter.page



   var template = HtmlService.createTemplateFromFile(page || 'Index3');  
 
 

    var pageData= template.evaluate()
    .setTitle('Fakultas Teknologi Industri Universitas Islam Indonesia')  
    .setFaviconUrl('https://www.uii.ac.id/wp-content/uploads/2017/02/Header-Logo-uii.png')
    .setSandboxMode(HtmlService.SandboxMode.IFRAME)   
    .addMetaTag('viewport', 'width=device-width, initial-scale=1')  
    .setXFrameOptionsMode(HtmlService.XFrameOptionsMode.ALLOWALL) 
     return pageData;
}
 
 
 
//INCLUDE JAVASCRIPT AND CSS FILES
function include(filename) {
  return HtmlService.createHtmlOutputFromFile(filename)
      .getContent();
}

function getJadwalUjian(){
  var spreadsheetId = '1P-Ouz8eTsnuE4ZQ0DBeAsGeDNYA3wiQC-WCZ6MLzDPU';  // Please set the spreadsheet ID.
  var targetSheet = 'mahasiswa_no_header';  // Please set the sheet name.

//
//var range = targetSheet.getRange(1, 1);
//var values = range.getValues();
//Logger.log(values[0][0]);


//const emailUser = Session.getActiveUser().getEmail();

const emailUser = "21524075@students.uii.ac.id"; 

  var query = 'select  L,U,K, G, H,J,F, V, AB where I = "'+emailUser+'" AND J<>"" ';  // Please set the query for retrieving the values.


  var ss = SpreadsheetApp.openById(spreadsheetId);
  var sheetId = ss.getSheetByName(targetSheet).getSheetId();

  var url = "https://docs.google.com/spreadsheets/d/" + spreadsheetId + "/gviz/tq?gid=" + sheetId + "&tqx=out:csv&tq=" + encodeURIComponent(query);
  var res = UrlFetchApp.fetch(url, {headers: {Authorization: "Bearer " + ScriptApp.getOAuthToken()}});
  var values = Utilities.parseCsv(res.getContentText());
  return values;
}
