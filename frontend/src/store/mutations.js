export default {
  changeTheme: (state, newThemeName) => {
    state.theme = newThemeName;
  },
  changeLoaderStatus: (state, {status, message = ''}) => {
    state.loader = {
      status,
      message
    };
  },
};
