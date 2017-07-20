Ext.define('sisscsj.view.objetivoespecifico.edit.tab.ObjetivoEspecifico3', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.objetivoespecifico.edit.tab.objetivoespecifico3',
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: false,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Información de Objetivo Específico (3 de 3)</strong>',
                    defaults: {
                        layout: 'hbox',
                        margins: '0 10 0 10'
                    },
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'medios_verificacion_objetivo_especifico',
                                    fieldLabel: 'Medios de Verificación',
                                    height: 100
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'supuestos_objetivo_especifico',
                                    fieldLabel: 'Supuestos',
                                    height: 100
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