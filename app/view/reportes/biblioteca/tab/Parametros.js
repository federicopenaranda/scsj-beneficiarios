Ext.define('sisscsj.view.reportes.biblioteca.tab.Parametros', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.reportes.biblioteca.tab.parametros',
    layout: 'form',
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Parámetros del Reporte</strong>',
                    defaults: {
                        layout: 'hbox',
                        margins: '0 10 0 10'
                    },
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'datefield',
                                    name: 'biblioteca_fecha_inicio',
                                    fieldLabel: 'Fecha de Inicio',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d'
                                },
                                {
                                    xtype: 'datefield',
                                    name: 'biblioteca_fecha_fin',
                                    fieldLabel: 'Fecha de Fin',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d'
                                }
                            ]
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
})