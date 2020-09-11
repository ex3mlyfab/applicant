import React from 'react';
import ReactDOM from 'react-dom';
import Solution from './Solution';


function App() {
    return (
        <div className="container">
            <Solution />
        </div>
    );
}

export default App;

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('App'));
}
