'use strict';

const e = React.createElement;

class LikeButton extends React.Component {
  constructor(props) {
    super(props);
    this.state = { liked: false };
  }

  render() {
    if (this.state.liked) {
      return 'You liked comment number ' + this.props.commentID;
    }

    return (
          <button onClick={() => this.setState({ liked: true })}>
            Like
          </button>
    );
    // return e(
    //   'button',
    //   { onClick: () => this.setState({ liked: true }) },
    //   'Like'
    // );
  }
}

// ... the starter code you pasted ...

const domContainer = document.querySelector('#like_button_container');
ReactDOM.render(<LikeButton />, domContainer);
// ReactDOM.render(e(LikeButton), domContainer);
// const domContainer = document.querySelector('.like_button_container');
// ReactDOM.render(e(LikeButton), domContainer);