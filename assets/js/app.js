import React from 'react';
import ReactDOM from 'react-dom';
  
 class App extends React.Component {
 
     render() {
         return (
             <div className="row">
                 test
             </div>
         );
     }
 }

 console.log('test');
//  console.log(document.getElementById('root'));
//  alert('test');
 
 ReactDOM.render(<App />, document.getElementById('root'));