import React from 'react';
import ReactDOM from 'react-dom';

import CardGame from './Containers/CardGame';

const MainApp = () => {

    return (
        <div className="row">
            <CardGame/>
        </div>
    );
 }
 
 ReactDOM.render(<MainApp />, document.getElementById('root'));