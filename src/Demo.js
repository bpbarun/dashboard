import React,{Component} from 'react';
// import ReactDOM from 'react-dom';
import './Demo.css';

class Demo extends Component{

/*	constructor(props) {
	super(props);
	this.state = {
	error: null,
	isLoaded: false,
	items: []
	};
	}

	componentDidMount() {
    fetch("http://localhost/displayfort-api/index.php/api/token/token/")
      .then(res => res.json())
      .then(
        (result) => {
          this.setState({
            isLoaded: true,
            items: result.error
          });
        },
        // Note: it's important to handle errors here
        // instead of a catch() block so that we don't swallow
        // exceptions from actual bugs in components.
        (error) => {
          this.setState({
            isLoaded: true,
            error
          });
        }
      )
  }
   render() {
    const { error, isLoaded, items } = this.state;
    if (error) {
      return <div>Error: {error.message}</div>;
    } else if (!isLoaded) {
      return <div>Loading...</div>;
    } else {
      return (
        <ul>
          {items.map(item => (
            <li key={item.name}>
              {item.name} {item.price}
            </li>
          ))}
        </ul>
      );
    }
  }
}
*/
   render(){
   	return <div class="maindiv_style"><h1>New {this.props.name}</h1>
   	<p>Welcome to Displayfort :)</p></div>
   }
}
export default Demo;