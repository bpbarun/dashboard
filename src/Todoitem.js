import React, {Component} from 'react';
import './App.css';

class TodoItem extends React.Component {
	state= {
		isEditing: false
	};
	toggleEditing= () =>{
		this.setState({
		 isEditing:!this.state.isEditing	
		})
	}
	clickHandler = () => {
		this.props.toggleCompeted(this.props.index)
	}
	deleetTodo = () =>{
		this.props.deleetTodoFromState(this.props.index)
	}
	editTodoSubmitHandler = (event)=>{
       event.preventDefault();
       this.props.editTodofromState(this.props.index,this.newText.value);
	   this.toggleEditing();
	}
	render(){
        const {todo} = this.props;
// (same as upper)       const todo  = this.props.todo;  
		if(this.state.isEditing) {
			return(

				<li>
				<form onSubmit = {this.editTodoSubmitHandler}>
				<input type="text" defaultValue={todo.text} ref={(node)=>{
					this.newText= node;
				}}/>
				<button type="submit">Save</button>
				<button onClick = {this.toggleEditing}>Cancel</button>
				</form>
				</li>
				)
		}else{
		return(
			<li className={todo.completed ? "completed":""} >
			<span onClick={this.clickHandler}>{todo.text}</span>
			<span>
				<button onClick ={this.deleetTodo}>Delete</button>
				<button onClick ={this.toggleEditing}>Edit</button>
			</span>
			</li>
			)
	}
	}
}
export default TodoItem;