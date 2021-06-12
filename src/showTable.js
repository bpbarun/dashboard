import React, {Component} from 'react';
class ShowTable extends Component {
	constructor() {
        super();
    }
     renderTableData() {
         let  moduleData = this.props.tableData;
         var langData = this.props.langData;
         var result = [];
         var results = [];
         var currentStringKey = '';
         var optionItems = '';
         console.log('Language data is =====',this.props.langData);
         if(this.props.tableData.data !== 'undefined'){
            var op = moduleData.map(function(item) {
            var keys = Object.keys(item);
            var arr = [];
            keys.forEach(function(key,value) {
            arr.push(item[key]);
            });
            return arr;
         });
           /*******************************************************************/
           Object.keys(moduleData).map(function(key, index) {
             // myObject[key] *= 2;
           });
            /******************************************************************/
             return moduleData.map( (item, key) => {
                  return (
                       <tr className = "odd gradeX" key = {item['string_id']}>
                <td>#</td>
                <td className = "left"> {item['string_value']}</td>
                {this.getValue(item)}
                <td>
                <button type="button" className="btn btn-primary btn-xs" onClick={this.handleChange} add-name={item['string_id']} add-id={item['string_value']}>Add value</button>

                </td>
                </tr>   
                      )
             });
        
         }
       // }
     }
    getValue(resData){
      var langData = this.props.langData;
      var langHtml =  '';
      var result = Object.keys(langData).map(function(key) {
      return [(key), langData[key]];
    });
        return result.map((res,index) =>   
        <td className = "left"> <input type="text" name ={resData['string_value']+'[]'} lang-code={res[0]} data-code={res[0]} defaultValue={resData[res[0]]}  id={resData['string_value']}/></td>     
    );
}
deletemultilingialData = (event) => {
    console.log('inside line no 58');
    var deleteID = event.target.attributes.getNamedItem('deleted-id').value;
    var deleteName = event.target.attributes.getNamedItem('deleted-name').value;
    console.log('deleteID is at line no 60', deleteID);
    this.props.deleteData(deleteID,deleteName);
}
 removeLastComma(str){
   return str.replace(/,(\s+)?$/, '');   
}
array_combine = (keys,values) => {  
var new_array = {};
let keycount=keys.length, i;

 for ( i=0; i < keycount; i++ ){  
  new_array[keys[i]] = values[i];  
}   
    return new_array;  
}
    handleChange    = (event) => {
      let id        = event.target.attributes.getNamedItem('add-name').value;
      let name      = event.target.attributes.getNamedItem('add-id').value;
//      let value     = document.getElementById(name).value;
//      let langData  = document.getElementById(name).value;
  let detai1=event.target.dataset.code;
/******************************************************************************/
var texts = document.getElementsByName(name+"[]");
    var sum = '';
    var lang = '';
    for(var i = 0; i < texts.length; i ++ ) {
    var n = texts[i].value || '';
    sum = sum + n+',';
    var l = texts[i].getAttribute("lang-code") || '';
    lang = lang + l + ',';
}
var finalStr = this.removeLastComma(sum);
var finalStrArray = finalStr.split(",");
var finalLang = this.removeLastComma(lang);
var finalLangArray = finalLang.split(",");
var mainArray  = this.array_combine(finalLangArray , finalStrArray);
console.log('lang main mainArray ====', mainArray);
/******************************************************************************/
      console.log('lang data is 544444===',finalStr);
      this.props.callAddText(mainArray,id,name);
    };
    langHtml(){
      var langData = this.props.langData;
      var langHtml =  '';    
    var result = Object.keys(langData).map(function(key) {
      return [(key), langData[key]];
    });
   return result.map((res,index) =>
   <th>{res[1]}</th>
  );     
}
    
  render () {
     
    return (
        <div>
             <table className="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                    <thead>
                    <tr>
                    <th></th>
                    <th>English Name </th>
                    {this.langHtml()}
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      {this.renderTableData()}
                    </tbody>
              </table>
        </div>      
        )
    }
}
export default ShowTable;





