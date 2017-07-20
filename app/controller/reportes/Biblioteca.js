Ext.define('sisscsj.controller.reportes.Biblioteca', {
    extend: 'sisscsj.controller.Base',
    stores: [

    ],
    views: [
        'reportes.biblioteca.Form',
        'reportes.biblioteca.Window',
        'reportes.biblioteca.tab.Parametros'
    ],
    refs: [
        {
            ref: 'ReporteBibliotecaWindow',
            selector: '[xtype=reportes.biblioteca.window]'
        },
        {
            ref: 'ReporteBibliotecaForm',
            selector: '[xtype=reportes.biblioteca.form]'
        },
        {
            ref: 'ReporteBibliotecaParametros',
            selector: '[xtype=reportes.biblioteca.tab.parametros]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'menu[xtype=layout.menu] menuitem#reporte_biblioteca': {
                    click: this.showReporteWindow
                },
                'window[xtype=reportes.biblioteca.window] button#cancel': {
                    click: this.close
                },
                'window[xtype=reportes.biblioteca.window] button#generar': {
                    click: this.generarReporte
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    /**
     * Persists edited record
     * @param {Ext.button.Button} button
     * @param {Ext.EventObject} e
     * @param {Object} eOpts
     */
    generarReporte: function(button, e, eOpts) {

    },
    
    showReporteWindow: function() {
        var me = this,
                win = me.getReporteBibliotecaWindow();
        
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('reportes.biblioteca.window', {
                title: 'Parámetros de Reporte de Biblioteca'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },
            
            
    /**
     * Persists edited record
     * @param {Ext.button.Button} button
     * @param {Ext.EventObject} e
     * @param {Object} eOpts
     */
    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    }
});