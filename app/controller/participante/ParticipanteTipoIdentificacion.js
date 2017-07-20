Ext.define('sisscsj.controller.participante.ParticipanteTipoIdentificacion', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'participante.ParticipanteTipoIdentificacion'
    ],
    views: [
        'participante.ListaTipoIdentificacion',
        'participante.Lista'
    ],
    refs: [
        {
            ref: 'ParticipanteTipoIdentificacionLista',
            selector: '[xtype=participante.listatipoidentificacion]'
        },
        {
            ref: 'ParticipanteLista',
            selector: '[xtype=participante.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=participante.listatipoidentificacion]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    select: this.habilitarBotones,
                    delselect: this.deshabilitarBotones
                },
                'grid[xtype=participante.listatipoidentificacion] button#add': {
                    click: this.add
                },
                'grid[xtype=participante.listatipoidentificacion] button#edit': {
                    click: this.edit2
                },
                'grid[xtype=participante.listatipoidentificacion] button#delete': {
                    click: this.remove
                },
                'grid[xtype=participante.listatipoidentificacion] gridview': {
                    itemadd: this.edit
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    loadRecords: function(grid, eOpts) {
        var me = this;
        var store = grid.getStore();
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        // clear any fliters that have been applied
        store.clearFilter(true);
        var contParticipante = me.getController('participante.Participante');
        
        // Se esta editando un participante
        if ( contParticipante.boolParticipanteEdit === 1)
        {
            var grid2 = me.getParticipanteLista();
            var dd = grid2.getSelectionModel().getSelection();

            if ( dd.length === 1 )
            {
                var record = dd[0];
                var data = record.getData();

                store.filter( 'fk_id_beneficiario', data['id_beneficiario'] );
            }
        }
        
        // Se deshabilita o habilita los botones de edit y delete
        // según se haya elegido un registro o no.
        var recStore = store.getRange();
        var arrRecords = grid.getSelectionModel().getSelection();

        if ( recStore.length === 0 || arrRecords.length === 0 )
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },
    
    
    habilitarBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getParticipanteTipoIdentificacionLista();
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");

        if ( botonEdit.disabled || botonDelete.disabled )
        {
            botonEdit.enable();
            botonDelete.enable();
        }
    },
    
    deshabilitarBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getParticipanteLista();
        var records = grid.getSelectionModel().getSelection();

        if (records.length > 0)
        {
            var grid2 = me.getParticipanteTipoIdentificacionLista();
            var botonEdit = grid2.down("[xtype='toolbar'] button#edit");
            var botonDelete = grid2.down("[xtype='toolbar'] button#delete");

            botonEdit.disable();
            botonDelete.disable();
        }
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    edit: function(records, index, node, eOpts) {
        var me = this,
                grid = me.getParticipanteTipoIdentificacionLista(),
                plugin = grid.editingPlugin;
        // start edit of row
        plugin.startEdit(records[ 0 ], 0);
    },


    edit2: function() {
        var me = this,
                grid = me.getParticipanteTipoIdentificacionLista(),
                plugin = grid.editingPlugin;

        var record = grid.getSelectionModel().getSelection()[0];
        // start edit of row
        plugin.startEdit(record, 0);
    },


    add: function(button, e, eOpts) {
        var me = this,
            record = Ext.create('sisscsj.model.participante.ParticipanteTipoIdentificacion');

        // [INICIO] Se recupera el ID del participante para asociarlo al registro del tipo de identificacion
        var grid1 = me.getParticipanteLista();
        var recSeleccionados = grid1.getSelectionModel().getSelection();
        
        var grid2 = me.getParticipanteTipoIdentificacionLista();
        var store2 = grid2.getStore();
        var contParticipante = me.getController('participante.Participante');

        // Participante ya creado
        if ( recSeleccionados.length === 1 && contParticipante.boolParticipanteEdit === 1 )
        {
            var record1 = recSeleccionados[0];
            var data1 = record1.getData();

            record.set('fk_id_beneficiario', data1['id_beneficiario']);

            store2.insert(0, record);
            grid2.cellEditing.startEditByPosition({
                row: 0, 
                column: 0
            });
        }
        else
        {
            // Participante nuevo
            if ( contParticipante.boolParticipanteEdit === 0 )
            {
                store2.insert(0, record);
                grid2.cellEditing.startEditByPosition({
                    row: 0, 
                    column: 0
                });
            }
            else
            {
                console.log('[ParticipanteTipoIdentificacion] Error al recuperar el ID del participante');
                return 'Error';
            }
        }
        // [FIN]
    },


    remove: function( button, e, eOpts ) {
        var me = this;
        var grid = me.getParticipanteTipoIdentificacionLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var contParticipante = me.getController('participante.Participante');

        // Se esta eliminando un registro del grid de Tipo de Identificacion
        // pero de un participante nuevo. Solo se quita del store.
        if ( contParticipante.boolParticipanteEdit === 0 )
        {
            store.remove(record);
        }
        // Se esta eliminando un registro del grid de Tipo de Identificación
        // pero de un participante ya creado. Si es un registro recién creado (phantom == true)
        // solo se quita del store. Si no es un registro recién creado se lo quita del store
        // y de la base de datos (sync).
        else
        {
            if ( record.phantom )
            {
                store.remove(record);
            }
            else
            {
                Ext.Msg.confirm({
                    title: 'Atención',
                    msg: '¿Esta seguro que desea eliminar este Tipo de Identificación?. Esta acción no puede ser deshecha.',
                    icon: Ext.Msg.QUESTION,
                    buttonText: {
                        yes: 'Eliminar',
                        no: 'Cancelar'
                    },
                    fn: function(buttonId, text, opt) 
                    {
                        if (buttonId === 'yes') {
                            store.remove(record);
                        }
                    }
                });
            }
        }

        var recStore = store.getRange();
        var arrRecords = grid.getSelectionModel().getSelection();

        if ( recStore.length === 0 || arrRecords.length === 0 )
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },


    sincronizar: function() {
        var me = this,
                grid = me.getParticipanteTipoIdentificacionLista(),
                store = grid.getStore();

        store.sync();
    }
});