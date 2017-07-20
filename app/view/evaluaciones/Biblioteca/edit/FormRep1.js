Ext.define('sisscsj.view.evaluaciones.Biblioteca.edit.FormRep1', {
    extend: 'Ext.form.Panel',
    alias: 'widget.evaluaciones.biblioteca.edit.formrep1',
    layout: 'form',
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Rango de Fechas para Reporte</strong>',
                    defaults: {
                        layout: 'vbox',
                        margins: '0 10 0 10'
                    },
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_inicio',
                                    fieldLabel: 'Fecha de Inicio',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d',
                                    allowBlank: false
                                },
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_fin',
                                    fieldLabel: 'Fecha de Fin',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d',
                                    allowBlank: false
                                }
                            ]
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});