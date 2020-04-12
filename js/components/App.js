import React from 'react';
import ReactDOM from 'react-dom';

function App() {
   return (
      <div className="container">
         <div className="row">
            <div className="col-md-8">
               <div className="card">
                  <div className="card-header">Home Page</div>

                  <div className="card-body">
                     This is the Home Page.
              </div>
               </div>
            </div>
            <div className="col-md-4">
               <div className="card">
                  <div className="card-header">Side Bar</div>

                  <div className="card-body">
                     This is a Side Bar.
              </div>
               </div>
            </div>
         </div>
      </div>
   );
}

export default App;

if (document.getElementById('root')) {
   ReactDOM.render(<App />, document.getElementById('root'));
}
