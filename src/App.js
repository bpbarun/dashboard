import React, {Component} from 'react';
import axios from 'axios';
import MultilingulaDropdown from './multilingulaDropdown';
import ShowTable from './showTable';


import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';


class App extends Component {
    state = {
        moduleData: [],
        todos: [],
        langArray: [],
    };
    componentDidMount() {
       
        axios.get('http://192.168.0.42/displayfort-dashboard/multilingual/getMultiLangualConfigData')
                .then(response => {
//                    console.log('multilingual config data of lang is ==', response);
                    if (response.data.status) {
                        this.setState({
                            todos: (response.data.data[0]['config_value'])
                        });
                        this.setState({
                            langArray: (JSON.parse(response.data.data[1]['config_value']))
                        });
                         
                    }
                })
                .catch(error => {
                    console.log(error);
                });
                var selectedData = '{"feedback_questions":["feedback_questions","feedback_questions_id","lang","string_key_id"],"feedback_type":["feedback_type_name","feedback_type_id","lang","string_key_id"],"feedback_string":["string_name","feedback_string_id","lang","string_key_id"]}';
                this.getModuleData(selectedData);
//                document.getElementById('multilingualModal').value = '{"feedback_questions":["feedback_questions","feedback_questions_id","lang","string_key_id"],"feedback_type":["feedback_type_name","feedback_type_id","lang","string_key_id"],"feedback_string":["string_name","feedback_string_id","lang","string_key_id"]}';
    }
    getModuleData = (module) => {
        this.setState({
            moduleData: []
        });
        var arr = [];
        if (typeof (module) == 'string') {
            let jsonData = JSON.parse(module);
            let jsonArray = [];
            for (var i in jsonData) {
                jsonArray.push([i, jsonData[i]]);
            }
            jsonArray.map((data, index) => {
                let table = data[0];
                let columnName = data[1];
                axios.post('http://192.168.0.42/displayfort-dashboard/multilingual/getMultiLangualModuleData', {
                    tableName: table,
                    columnName: columnName.toString()
                })
                        .then((response) => {
                            if (response.data.status) {
                                const currentState = this.state.moduleData.concat((response.data.data));
                                this.setState({
                                    moduleData: currentState
                                });
                            } else {
                                this.setState({
                                    moduleData: []
                                });
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
            });
        }
    }
    deleteMultilingualdata = (id,name) => {
        console.log('delete datya inside app.js is', id);
         let selectOption=  document.getElementById('multilingualModal').value;
        if(selectOption == '' || selectOption == 'undefined'){
            selectOption =  '{"feedback_questions":["feedback_questions","feedback_questions_id","lang","string_key_id"],"feedback_type":["feedback_type_name","feedback_type_id","lang","string_key_id"],"feedback_string":["string_name","feedback_string_id","lang","string_key_id"]}';
        }
        axios.post('http://192.168.0.42/displayfort-dashboard/multilingual/deleteMultiLangualModuleData', {
            id: id,
            name :name,
             moduleName: selectOption
        })
                .then((response) => {
                   this.notifyA('Record deleted successfully');
//                   this.getModuleData();
                })
                .catch(function (error) {
                    console.log(error);
                });
    }
    addNameText = (textValue, id, enName) => {
        console.log('textValue is ==', textValue);
        console.log('id is ==', id);
        console.log('enName is ==', enName);
        let selectOption=  document.getElementById('multilingualModal').value;
        if(selectOption == '' || selectOption == 'undefined'){
            selectOption =  '{"feedback_questions":["feedback_questions","feedback_questions_id","lang","string_key_id"],"feedback_type":["feedback_type_name","feedback_type_id","lang","string_key_id"],"feedback_string":["string_name","feedback_string_id","lang","string_key_id"]}';
        }
        console.log('Selected option',selectOption);
        console.log('Selected option type',typeof(selectOption));
        axios.put('http://192.168.0.42/displayfort-dashboard/multilingual/addMultiLangualModuleData', {
            id: id,
            enName: enName,
            textValue: textValue,
            moduleName: selectOption
        })
                .then((response) => {
                    if (response.data.status) {
//                        const currentState = this.state.moduleData.concat((response.data.data));
//                        this.setState({
//                            moduleData: currentState
//                        });
                        this.notifyA('Record added successfully');
//                       this.getModuleData('');
                    } else {
                        this.setState({
                            moduleData: []
                        });
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
    }
     notifyA = (msg) => {
      toast.success(msg, {containerId: 'A'});   
     }

    render() {
        var jsonData = '';
        if (this.state.todos.length > 0) {
            this.setState({
                todos: JSON.parse(this.state.todos)
            });
        }
        return (
                <div>
                    <ToastContainer enableMultiContainer containerId={'A'} position={toast.POSITION.TOP_RIGHT} autoClose={3000}/>
                    <MultilingulaDropdown state={this.state.todos}  selectedModule={this.getModuleData}/>
                    <ShowTable tableData={this.state.moduleData} callAddText ={this.addNameText} deleteData ={this.deleteMultilingualdata} langData={this.state.langArray}/>
                </div>
                )
    }
}
export default App;
