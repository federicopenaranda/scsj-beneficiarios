Ext.define('sisscsj.view.marcologico.edit.tab.MarcoLogico', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.marcologico.edit.tab.marcologico',
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
                    title: '<strong>Información de Marco Lógico</strong>',
                    defaults: {
                        layout: 'hbox',
                        margins: '0 10 0 10'
                    },
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Código:',
                                    name: 'codigo_marco_logico'
                                },
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_marco_logico',
                                    fieldLabel: 'Fecha de Inicio',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'combo',
                                    name: 'estado_marco_logico',
                                    itemId: 'estado_marco_logico',
                                    allowBlack: false,
                                    store: LocalStoreEstado,
                                    triggerAction: 'all',
                                    valueField: 'valor',
                                    displayField: 'nombre',
                                    queryMode: 'local',
                                    forceSelection: true,
                                    editable: false,
                                    fieldLabel: 'Estado:'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'observaciones_marco_logico',
                                    fieldLabel: 'Observaciones',
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