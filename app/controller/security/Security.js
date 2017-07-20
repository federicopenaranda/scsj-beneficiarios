Ext.define('sisscsj.controller.Security', {
    extend: 'sisscsj.controller.Base',
    requires: [
        'sisscsj.security.crypto.SHA1'
    ],
    models: [
        'security.User'
    ],
    views: [
        'security.login.Form',
        'security.login.Window'
    ],
    refs: [
        {
            ref: 'LoginForm',
            selector: '[xtype=security.login.form]'
        },
        {
            ref: 'LoginWindow',
            selector: '[xtype=security.login.window]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                '[xtype=security.login.window] button#login': {
                    click: this.doLogin
                },
                'menu[xtype=layout.menu] menuitem#logout': {
                    click: this.doLogout
                }
            },
            global: {
                //beforeviewportrender: this.processLoggedIn
            },
            store: {},
            proxy: {} 
        });
    },
    /**
     * Main method process security check
     */
    processLoggedIn: function() {
        var me = this;
        Ext.widget( 'security.login.window' ).show();
    },
    /**
     * Handles form submission for login
     * @param {Ext.button.Button} button
     * @param {Ext.EventObject} e
     * @param {Object} eOpts
     */
    doLogin: function( button, e, eOpts ) {
        var me = this,
            win = button.up( 'window' ),
            form = win.down( 'form' ),
            values = form.getValues(),
            hashedPassword;
        
        // simple validation
        if( Ext.isEmpty( values.Username ) || Ext.isEmpty( values.Password ) ) {
            Ext.Msg.alert( 'Atención', 'Por favor completar el formulario de ingreso.' );
            return false;
        }
        
        Ext.data.JsonP.request({
            url: sisscsj.app.globals.globalServerPath + 'usuario/login',
            params: {
                login_usuario: values.Username,
                password_usuario: sisscsj.security.crypto.SHA1.hash( values.Password )
            },
            success: function( response, options ) {
                // check if success flag is true
                if( response.success === 'true' ) {
                    // has session...add to application stack
                    sisscsj.LoggedInUser = Ext.create( 'sisscsj.model.security.User', response.data );
                    // fire global event aftervalidateloggedin
                    Ext.globalEvents.fireEvent( 'aftervalidateloggedin' );
                    // show message
                    Ext.Msg.alert( 'Atención', 'Ingresaste Correctamente. Bienvenido al Sistema SISSCSJ.' );
                    // close window
                    win.close();
                } 
                // couldn't login...show error
                else {
                    Ext.Msg.alert( 'Error', response.msg );
                }
            },
            failure: function( response, options ) {
                Ext.Msg.alert( 'Atención', 'Un error ocurrió al ingresar. Por favor intenta nuevamente.' );
            }
            
        });
    },
    /**
     * Handles logout
     * @param {Ext.button.Button} button
     * @param {Ext.EventObject} e
     * @param {Object} eOpts
     */
    doLogout: function( button, e, eOpts ) {
        var me = this;
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que quiere salir del sistema SISSCSJ?',
            icon: Ext.Msg.QUESTION,
            buttonText: {
                yes: 'Salir',
                no: 'Cancelar'
            },
            fn: function(buttonId, text, opt) 
            {
                if (buttonId == 'yes') {
                    Ext.data.JsonP.request({
                        url: sisscsj.app.globals.globalServerPath + 'usuario/logout',
                        success: function( response, options ) {
                            window.location.href = './index.php';
                        },
                        failure: function( response, options ) {
                            Ext.Msg.alert( 'Atención', 'Un error ocurrió al ingresar. Por favor intenta nuevamente.' );
                        }
                    });
                }
            }
        });
    }
});