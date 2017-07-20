Ext.define('sisscsj.view.beneficiario.edit.tab.Otros', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.otros',
    layout: 'form',
    width: 1000,
    height: 400,
    hideMode: 'offsets',
    autoScroll: true,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Otra Información</strong>',
                    defaults: {
                        layout: 'fit',
                        margins: '0 10 0 10'
                    },
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'observacion_beneficiario',
                                    fieldLabel: '<strong>Observaciones</strong>',
                                    height: 150,
                                    allowBlank: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'informacion_relevante_beneficiario',
                                    fieldLabel: '<strong>Información Relevante</strong>',
                                    height: 150,
                                    allowBlank: true
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