Ext.define('sisscsj.view.objetivoespecifico.edit.tab.ObjetivoEspecifico2', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.objetivoespecifico.edit.tab.objetivoespecifico2',
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
                    title: '<strong>Información de Objetivo Específico (2 de 3)</strong>',
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
                                    name: 'metas_objetivo_especifico',
                                    fieldLabel: 'Metas',
                                    height: 100
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'indicadores_objetivo_especifico',
                                    fieldLabel: 'Indicadores',
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