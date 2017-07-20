Ext.define('sisscsj.view.usuario.edit.tab.Usuario', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.usuario.edit.tab.usuario',
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: true,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Información de Usuario</strong>',
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
                                    fieldLabel: 'Nombre de Usuario:',
                                    name: 'nombre_usuario',
                                    allowBlank: false
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Apellido de Usuario:',
                                    name: 'apellido_usuario',
                                    allowBlank: false
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    name: 'sexo_usuario',
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
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Teléfono de Usuario:',
                                    name: 'telefono_usuario'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Celular de Usuario:',
                                    name: 'celular_usuario',
                                    allowBlank: false
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: 'Correo de Usuario:',
                                    name: 'correo_usuario',
                                    vtype: 'email',
                                    msgTarget: 'side',
                                    allowBlank: false
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'textareafield',
                                    name: 'direccion_usuario',
                                    fieldLabel: 'Dirección',
                                    height: 100
                                },
                                {
                                    xtype: 'textareafield',
                                    name: 'observacion_usuario',
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