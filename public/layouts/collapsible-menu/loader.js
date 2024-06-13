window.addEventListener("load", function () {

    // Remove Loader
    var load_screen = document.getElementById("load_screen");
    document.body.removeChild(load_screen);

    var layoutName = 'Collapsible Menu';

    var settingsObject = {
        admin: 'Equation Admin Template',
        settings: {
            layout: {
                name: layoutName,
                toggle: true,
                darkMode: false,
                boxed: false,
                logo: {
                    darkLogo: '../src/assets/img/logo.svg',
                    lightLogo: '../src/assets/img/logo.svg'
                }
            }
        },
        reset: false
    }

    if (settingsObject.reset) {
        localStorage.clear();
    }

    var equationThemeObject;

    if (localStorage.length === 0) {
        equationThemeObject = settingsObject;
    } else {
        var getequationThemeObject = localStorage.getItem("theme");
        var getParseObject;

        try {
            getParseObject = JSON.parse(getequationThemeObject);
        } catch (e) {
            console.error("Error parsing JSON from localStorage", e);
            getParseObject = null;
        }

        if (getParseObject) {
            if (getParseObject.admin === 'Equation Admin Template') {
                if (getParseObject.settings.layout.name === layoutName) {
                    equationThemeObject = getParseObject;
                } else {
                    equationThemeObject = settingsObject;
                }
            } else {
                if (getParseObject.admin === undefined) {
                    equationThemeObject = settingsObject;
                }
            }
        } else {
            equationThemeObject = settingsObject;
        }
    }

    // Save the theme object to localStorage
    localStorage.setItem("theme", JSON.stringify(equationThemeObject));

    // Get Dark Mode Information i.e darkMode: true or false
    if (equationThemeObject.settings.layout.darkMode) {
        document.body.classList.add('dark');
        var logoSrc = document.body.getAttribute('page') === 'starter-pack' ? '../../src/assets/img/logo.svg' : equationThemeObject.settings.layout.logo.darkLogo;
        if (document.querySelector('.navbar-logo')) {
            document.querySelector('.navbar-logo').setAttribute('src', logoSrc);
        }
    } else {
        document.body.classList.remove('dark');
        var logoSrc = document.body.getAttribute('page') === 'starter-pack' ? '../../src/assets/img/logo2.svg' : equationThemeObject.settings.layout.logo.lightLogo;
        if (document.querySelector('.navbar-logo')) {
            document.querySelector('.navbar-logo').setAttribute('src', logoSrc);
        }
    }

    // Get Layout Information i.e boxed: true or false
    if (equationThemeObject.settings.layout.boxed) {
        document.body.classList.add('layout-boxed');
        if (document.querySelector('.header-container')) {
            document.querySelector('.header-container').classList.add('container-xxl');
        }
        if (document.querySelector('.middle-content')) {
            document.querySelector('.middle-content').classList.add('container-xxl');
        }
    } else {
        document.body.classList.remove('layout-boxed');
        if (document.querySelector('.header-container')) {
            document.querySelector('.header-container').classList.remove('container-xxl');
        }
        if (document.querySelector('.middle-content')) {
            document.querySelector('.middle-content').classList.remove('container-xxl');
        }
    }
});
