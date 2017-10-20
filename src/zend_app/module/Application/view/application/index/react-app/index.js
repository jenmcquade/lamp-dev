import React from 'react';
import ReactDOM from 'react-dom';
import { AppContainer } from 'react-hot-loader'

import App from './App';
import registerServiceWorker from './registerServiceWorker';
import formActions from './ui-forms.js';

const renderApp = Component => {
  ReactDOM.render(
    <AppContainer>
      <Component />
    </AppContainer>,
    document.getElementById('root')
  );
};

renderApp(App);

if (module.hot) {
  module.hot.accept('./App', () => {
      const NextApp = require('./App').default;
      renderApp(
        NextApp,
        document.getElementById('root'),
      );
  });
}

registerServiceWorker();


