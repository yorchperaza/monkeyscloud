// ./src/js/app.js

import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { faCheckSquare, faCoffee } from '@fortawesome/free-solid-svg-icons';

library.add(fab, faCheckSquare, faCoffee);

import '../css/app.css';
import Home from './components/Home';
import UserRegister from './components/UserRegister';

ReactDOM.render(<Home />, document.getElementById('root'));
ReactDOM.render(<UserRegister />, document.getElementById('form'));