Ext.define('sisscsj.view.participante.edit.tab.Personal', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.participante.edit.tab.personal',
    layout: 'form',
    width: 1000,
    height: 400,
    autoScroll: true,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                labelAlign: 'top',
                allowBlank: true,
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Información Personal</strong>',
                    defaults: {
                        allowBlank: true,
                        layout: 'hbox',
                        margins: '0 10 0 10'
                    },
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textfield',
                                    name: 'primer_nombre_beneficiario',
                                    id: 'primer_nombre_beneficiario',
                                    fieldLabel: 'Primer Nombre:',
                                    allowBlank: false
                                },
                                {
                                    xtype: 'textfield',
                                    name: 'segundo_nombre_beneficiario',
                                    id: 'segundo_nombre_beneficiario',
                                    fieldLabel: 'Segundo Nombre:',
                                    allowBlank: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textfield',
                                    name: 'apellido_paterno_beneficiario',
                                    id: 'apellido_paterno_beneficiario',
                                    fieldLabel: 'Apellido Paterno:',
                                    allowBlank: false
                                },
                                {
                                    xtype: 'textfield',
                                    name: 'apellido_materno_beneficiario',
                                    id: 'apellido_materno_beneficiario',
                                    fieldLabel: 'Apellido Materno:',
                                    allowBlank: true
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_nacimiento_beneficiario',
                                    id: 'fecha_nacimiento_beneficiario',
                                    fieldLabel: 'Fecha de Nac.',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d',
                                    allowBlank: false
                                },
                                {
                                    name: 'sexo_beneficiario',
                                    xtype: 'combo',
                                    fieldLabel: 'Sexo:',
                                    store: LocalStoreSexos,
                                    triggerAction: 'all',
                                    valueField: 'valor',
                                    displayField: 'nombre',
                                    queryMode: 'local',
                                    forceSelection: true,
                                    editable: false,
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