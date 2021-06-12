import React, {Component} from 'react';
class MultilingulaDropdown extends Component {
    constructor() {
        super();
    }
    state = {
        dropDown: {}
    };
    handleChange = (event) => {
        this.setState({dropDown: event.target.value});
        this.props.selectedModule(event.target.value);
    }
    ;
            render() {
        let propsData = this.props.state;
        let jsonData = typeof (propsData);
        console.log('jsondata is ===', jsonData);
        if (typeof (propsData) == 'object') {
            var result = [];
            for (var i in propsData) {
                result.push([i, propsData[i]]);
            }
            var optionItems = result.map((res, index) =>
                <option value={JSON.stringify(res[1])}>{res[0]}</option>
            );
        }
        return (
                <div>
                    <select className="form-control  select2" id="multilingualModal" onChange={this.handleChange} value={this.state.dropDown}>
                        <option value =""> Choose a module</option>
                        {optionItems}
                    </select>
                </div>
                )
    }
}

export default MultilingulaDropdown;





