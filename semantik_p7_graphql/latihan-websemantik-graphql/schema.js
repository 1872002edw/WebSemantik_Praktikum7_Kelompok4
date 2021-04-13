// schema.js
const axios = require('axios')
const {
  GraphQLObjectType,
  GraphQLString,
  GraphQLInt,
  GraphQLSchema,
  GraphQLList,
  GraphQLNonNull
} = require('graphql')
const server = 'http://localhost:3000'

const MahasiswaType = new GraphQLObjectType({
    name: 'Mahasiswa',
    fields: () => ({
      nrp: { type: GraphQLString },
      nama: { type: GraphQLString },
      foto: { type: GraphQLString },
      prodi: { type: GraphQLString },
      fakultas: { type: GraphQLString },
      universitas: { type: GraphQLString }
    }),
  })

  const RootQuery = new GraphQLObjectType({
    name: 'RootQueryType',
    fields: {
      mahasiswa: {
        type: new GraphQLList(MahasiswaType),
        resolve(_parentValue_, _args_) {
          return axios.get(`${server}/mahasiswa/`)
            .then(res => res.data)
        }
      }
    }
  })
// =============================================================================
  const mutation = new GraphQLObjectType({
    name: 'Mutation',
    fields: {
      addMahasiswa: {
        type: MahasiswaType,
        args: {
          nrp: { type: new GraphQLNonNull(GraphQLString) },
          nama: { type: new GraphQLNonNull(GraphQLString) },
          foto: { type: new GraphQLNonNull(GraphQLString) },
          prodi: { type: new GraphQLNonNull(GraphQLString) },
          fakultas: { type: new GraphQLNonNull(GraphQLString) },
          universitas: { type: new GraphQLNonNull(GraphQLString) }
        },
        resolve(parentValue, args) {
          return axios.post(`${server}/mahasiswa`, {
            nrp:args.nrp,
            nama: args.nama,
            foto: args.foto,
            prodi: args.prodi,
            fakultas: args.fakultas,
            universitas: args.universitas,
            
          }).then(res => res.data)
        },
      },
      findMahasiswa: {
        type: MahasiswaType,
        args: {
          nrp: { type: GraphQLString},
        },
        resolve(parentValue, args) {
          return axios.get(`${server}/mahasiswa/${args.nrp}`)
            .then(res => res.data)
        }
      },
      updateMahasiswa: {
        type: MahasiswaType,
        args: {
            nrp: { type: new GraphQLNonNull(GraphQLString) },
            nama: { type: new GraphQLNonNull(GraphQLString) },
            foto: { type: new GraphQLNonNull(GraphQLString) },
            prodi: { type: new GraphQLNonNull(GraphQLString) },
            fakultas: { type: new GraphQLNonNull(GraphQLString) },
            universitas: { type: new GraphQLNonNull(GraphQLString) }
        },
        resolve(parentValue, args) {
          return axios.put(`${server}/mahasiswa/${args.nrp}`, args)
            .then(res => res.data)
        },
      },
      deleteMahasiswa: {
        type: MahasiswaType,
        args: {
          nrp: { type: new GraphQLNonNull(GraphQLInt) },
        },
        resolve(parentValue, args) {
          return axios.delete(`${server}/mahasiswa/${args.nrp}`, args )
           .then(res => res.data)
        },
      },
    }
  })

  module.exports = new GraphQLSchema({
    query: RootQuery,
    mutation,
  })

