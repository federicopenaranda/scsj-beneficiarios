Ext.define('sisscsj.view.objetivoespecifico.edit.tab.ObjetivoEspecifico', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.objetivoespecifico.edit.tab.objetivoespecifico',
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
                    title: '<strong>Información de Objetivo Específico (Paso 1)</strong>',
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
                                    name: 'descripcion_objetivo_especifico',
                                    fieldLabel: 'Descripción',
                                    height: 160
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