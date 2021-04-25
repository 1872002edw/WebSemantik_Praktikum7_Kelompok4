const express = require("express");
const expressGraphQL = require("express-graphql").graphqlHTTP;
const { GraphQLSchema,
    GraphQLObjectType,
    GraphQLString,
    GraphQLList,
    GraphQLNonNull } = require("graphql");
const app = express();

const daftarmahasiswa = [
  {
    nrp: "1872000",
    nama: "Harry Potter",
    foto: "1872000.jpg",
    prodi: "Teknik Informatika",
    fakultas: "Teknologi Informasi",
    universitas: "Hogwarts",
  },
  {
    nrp: "1872002",
    nama: "Edward",
    foto: "1872002.jpg",
    prodi: "Teknik Informatika",
    fakultas: "Teknologi Informasi",
    universitas: "Maranatha",
  },
  {
    nrp: "1872027",
    nama: "Anthony",
    foto: "1872027.jpg",
    prodi: "Teknik Informatika",
    fakultas: "Teknologi Informasi",
    universitas: "Maranatha",
  },
  {
    nrp: "1872051",
    nama: "Edwin",
    foto: "1872051.jpg",
    prodi: "Teknik Informatika",
    fakultas: "Teknologi Informasi",
    universitas: "Maranatha",
  },
  {
    nrp: "1782001",
    nama: "Hermoine",
    foto: "1882001.jpg",
    prodi: "Psikologi",
    fakultas: "Psikologi",
    universitas: "Hogwarts",
  },
];

const MahasiswaType = new GraphQLObjectType({
  name: "Mahasiswa",
  description: "This represents a book written by an author",
  fields: () => ({
    nrp: { type: GraphQLNonNull(GraphQLString) },
    nama: { type: GraphQLNonNull(GraphQLString) },
    foto: { type: GraphQLNonNull(GraphQLString) },
    prodi: { type: GraphQLNonNull(GraphQLString) },
    fakultas: { type: GraphQLNonNull(GraphQLString) },
    universitas: { type: GraphQLNonNull(GraphQLString) },
  }),
});

const RootQueryType = new GraphQLObjectType({
  name: "Query",
  description: "Root Query",
  fields: () => ({
    daftarmahasiswa: {
      type: new GraphQLList(MahasiswaType),
      description: "Daftar semua mahasiswa",
      resolve: () => daftarmahasiswa,
    }
  }),
});

const RootMutationType = new GraphQLObjectType({
    name: 'Mutation',
    description: 'Root Mutation',
    fields: () => ({
      addMahasiswa: {
        type: MahasiswaType,
        description: 'Add mahasiswa',
        args: {
            nrp: { type: GraphQLNonNull(GraphQLString) },
            nama: { type: GraphQLNonNull(GraphQLString) },
            foto: { type: GraphQLNonNull(GraphQLString) },
            prodi: { type: GraphQLNonNull(GraphQLString) },
            fakultas: { type: GraphQLNonNull(GraphQLString) },
            universitas: { type: GraphQLNonNull(GraphQLString) },
        },
        resolve: (parent, args) => {
          const mahasiswa = { nrp: args.nrp, nama: args.nama, foto: args.foto,
                            prodi: args.prodi, fakultas: args.fakultas, universitas: args.universitas, }
          daftarmahasiswa.push(mahasiswa)
          return mahasiswa
        }
      },
    })
  })


const schema = new GraphQLSchema({
    query: RootQueryType,
    mutation: RootMutationType
  })

app.use(
  "/graphql",
  expressGraphQL({
    schema: schema,
    graphiql: true,
  })
);
app.listen(5000, () => console.log("Server Running"));
