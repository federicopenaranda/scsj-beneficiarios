Ext.define('sisscsj.view.beneficiario.edit.tab.Personal', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.beneficiario.edit.tab.personal',
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
                                    allowBlank: true
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
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_religion',
                                    fieldLabel: 'Religión:',
                                    displayField: 'nombre_religion',
                                    valueField: 'id_religion',
                                    store: {
                                        type: 'opciones.religion'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    editable: false,
                                    forceSelection: true,
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
               },
               {
                    xtype: 'fieldset',
                    title: '<strong>Foto de Beneficiario</strong>',
                    defaults: {
                        layout: 'hbox',
                        allowBlank: true,
                        margins: '0 10 0 10'
                    },
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'form',
                                    itemId: 'uploadform',
                                    vtype:'fileUpload',
                                    border: false,
                                    frame: false,
                                    bodyPadding: 0,
                                    margins: '0 0 -5 0',
                                    baseCls: 'x-plain',
                                    hasUpload: true,
                                    items: [
                                        {
                                            xtype: 'filefield',
                                            name: 'Beneficiario[fotografia_beneficiario]',
                                            itemId: 'fotografia_beneficiario',
                                            fieldLabel: 'Cargar Foto',
                                            allowBlank: true,
                                            fieldWidth: 300,
                                            buttonConfig: {
                                                iconCls: 'icon_picture',
                                                text: ''
                                            },
                                            labelAlign: 'left'
                                        }
                                    ]
                                },
                                {
                                    xtype : 'image',
                                    itemId : 'displayimage',
                                    width: 320,
                                    height: 240
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