Ext.define('sisscsj.view.beneficiario.edit.tab.Patrocinador', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.patrocinador',
    layout: 'form',
    width: 1000,
    height: 400,
    autoScroll: true,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Información de Patrocinador</strong>',
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
                                    name: 'nombre_patrocinador_beneficiario_patrocinador',
                                    fieldLabel: 'Patrocinador:',
                                    allowBlank: true
                                },
                                {
                                    xtype: 'textfield',
                                    name: 'numero_caso_beneficiario_patrocinador',
                                    fieldLabel: 'Número de Caso:',
                                    allowBlank: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textfield',
                                    name: 'numero_ninio_beneficiario_patrocinador',
                                    fieldLabel: 'Número de Niño:',
                                    allowBlank: true
                                },
                                {
                                    xtype: 'textfield',
                                    name: 'codigo_donante_beneficiario_patrocinador',
                                    fieldLabel: 'Código de Donante:',
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


